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

        if (craft()->sections->saveSection($section)){
            $model->setAttribute('sectionId', $section->getAttribute('id'));
            if (craft()->teamManager->saveTeam($model)) {
                craft()->userSession->setNotice(Craft::t('Team successfully saved.'));
            } else
                craft()->userSession->setNotice(Craft::t('Team could not be saved.'));
        } else
            craft()->userSession->setNotice(Craft::t('Team section could not be saved.'));
    }

    public function actionDeleteTeam($id)
    {
        $model = craft()->teamManager->getTeam($id);
        if ($model) {
            craft()->sections->deleteSectionById($model->getAttribute('sectionId'));

            craft()->teamManager->deleteTeam($id);
            craft()->userSession->setNotice(Craft::t('Team successfully deleted.'));
            $this->redirect('teammanager');
        }
    }
}