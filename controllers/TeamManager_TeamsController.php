<?php

namespace Craft;

class TeamManager_TeamsController extends BaseController
{


    public function actionSaveTeam()
    {
        $illegalSlugCharacters = array_merge(range(chr(0),chr(47)), range(chr(58),chr(64)), range(chr(91),chr(96)), range(chr(123),chr(127)));

        $this->requirePostRequest();

        $teamName = craft()->request->getPost('teamName');
        $values = array(
            'teamName' => $teamName,
            'slug' => rtrim(preg_replace('!\s+!', '-', strtolower(str_replace($illegalSlugCharacters, ' ', $teamName))), '-'),
        );

        $id = craft()->request->getPost('teamId');
        if ($id) {
            $model = craft()->teamManager->getTeam($id);
            $model->setAttributes($values);
        } else {
            $model = craft()->teamManager->newTeam($values);
        }

        if (craft()->teamManager->saveTeam($model)) {
            craft()->userSession->setNotice(Craft::t('Team successfully saved.'));

//            return $this->redirectToPostedUrl();
        } else
            craft()->userSession->setNotice(Craft::t('Team could not be saved.'));
    }

    public function actionDeleteTeam($id)
    {
        craft()->teamManager->deleteTeam($id);

        craft()->userSession->setNotice(Craft::t('Team successfully deleted.'));
        $this->redirect('teammanager');
    }
}