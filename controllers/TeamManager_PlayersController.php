<?php

namespace Craft;

class TeamManager_PlayersController extends BaseController
{

    protected $allowAnonymous = true;

    public function actionSavePlayer()
    {
        $this->requirePostRequest();

        $model = new TeamManager_PlayerModel();

        $model->name = craft()->request->getPost('name');
        $model->birth = craft()->request->getPost('birth');
        $model->address = craft()->request->getPost('address');
        $model->telephone = craft()->request->getPost('telephone');
        $model->email = craft()->request->getPost('email');

        //Obtaining extra data
        $dataNodes = array(
            'previousClub',
            'previousLeague',
            'medicalIssues',
            'parentName1',
            'parentName2',
            'parentsAddress',
            'parentTelephone1',
            'parentTelephone2',
            'parentEmail1',
            'parentEmail2',
            'shortsSize',
            'shirtSize'
        );

        $data = array();
        foreach ($dataNodes as $node) {
            $model->$node = craft()->request->getPost($node);
            $data[$node] = craft()->request->getPost($node);
        }

        $model->data = $data;

        if ($model->validate() && craft()->teamManager->savePlayer($model)) {
                craft()->urlManager->setRouteVariables(array(
                    'success' => true
                ));
//            craft()->userSession->setNotice(' Thank you for registering! Your registration form has successfully been saved');
        } else {
//            craft()->userSession->setError('Error, please check all the required fields and try again!');
            craft()->urlManager->setRouteVariables(array(
                'player' => $model
            ));
        }
    }

    public function actionDeletePlayer()
    {
        $this->requirePostRequest();
        $this->requireAjaxRequest();

        $id = craft()->request->getRequiredPost('id');

        $model = craft()->teamManager->getPlayer($id);
        if ($model) {
            craft()->teamManager->deletePlayer($id);
            craft()->userSession->setNotice(Craft::t('Player was successfully deleted.'));
            $this->returnJson(array('success' => true));
        }
    }
}