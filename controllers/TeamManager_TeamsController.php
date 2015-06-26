<?php

namespace Craft;

class TeamManager_TeamsController extends BaseController
{


    public function actionSaveTeam()
    {
        $illegalSlugCharacters = array_merge(range(chr(0),chr(47)), range(chr(58),chr(64)), range(chr(91),chr(96)), range(chr(123),chr(127)));

        $this->requirePostRequest();

        $teamName = craft()->request->getPost('teamName');
        $slug = rtrim(strtolower(str_replace($illegalSlugCharacters, '_', $teamName)), '_');

        $counter = 1;
        $slugPrefix = "";
        while(craft()->teamManager->getTeamBySlug($slug . $slugPrefix)){
            $slugPrefix = '_' . $counter++;
            if($counter > 10000)
                break;
        }
        $slug .= $slugPrefix;

        if($counter > 1)
            craft()->userSession->setError(Craft::t('Team "'.$teamName.'" already exists, so it was renamed to "'. ($teamName .= str_replace('_', ' ', $slugPrefix)) .'"'));

        $values = array(
            'teamName' => $teamName,
            'slug' => $slug,
        );

        //TODO check for preconditions

        $id = craft()->request->getPost('teamId');
        if ($id) {
            $model = craft()->teamManager->getTeam($id);
            $model->setAttributes($values);
        } else {
            $model = craft()->teamManager->newTeam($values);
        }

        //Create a new section
        $section = new SectionModel();

        // Shared attributes
        $section->id               = craft()->request->getPost('sectionId');
        $section->name             = $teamName;
        $section->handle           = $slug;
        $section->type             = SectionType::Channel;
        $section->enableVersioning = true;
        $section->hasUrls          = false;

        $locales = array();

        $primaryLocaleId = craft()->i18n->getPrimarySiteLocaleId();
        $localeIds = array($primaryLocaleId);

        foreach ($localeIds as $localeId)
        {
            $urlFormat       = 'types.section.urlFormat.'.$localeId;
            $nestedUrlFormat = 'types.section.nestedUrlFormat.'.$localeId;

            $locales[$localeId] = new SectionLocaleModel(array(
                'locale'           => $localeId,
                'enabledByDefault' => true,
                'urlFormat'        => $urlFormat,
                'nestedUrlFormat'  => $nestedUrlFormat,
            ));
        }

        $section->setLocales($locales);

        //Create a new user group
        $group = new UserGroupModel();
        $group->id = craft()->request->getPost('groupId');
        $group->name = $teamName;
        $group->handle = $slug;

        if (craft()->sections->saveSection($section)){
            $model->setAttribute('sectionId', $section->getAttribute('id'));

            if (!craft()->userGroups->saveGroup($group)){
                craft()->userSession->setError(Craft::t('Team group could not be saved.'));
                return;
            }
            $model->setAttribute('groupId', $group->getAttribute('id'));

            if (craft()->teamManager->saveTeam($model)) {
                craft()->userSession->setNotice(Craft::t('Team successfully saved.'));
            } else
                craft()->userSession->setError(Craft::t('Team could not be saved.'));
        } else
            craft()->userSession->setError(Craft::t('Team section could not be saved.'));

        $this->redirect('teammanager');
    }

    public function actionDeleteTeam()
    {
        $this->requirePostRequest();
        $this->requireAjaxRequest();

        $id = craft()->request->getRequiredPost('id');

        $model = craft()->teamManager->getTeam($id);
        if ($model) {
            craft()->sections->deleteSectionById($model->getAttribute('sectionId'));
            craft()->userGroups->deleteGroupById($model->getAttribute('groupId'));

            craft()->teamManager->deleteTeam($id);
            craft()->userSession->setNotice(Craft::t('Team successfully deleted.'));
            $this->returnJson(array('success' => true));
        }
    }
}