<?php

namespace Craft;

class TeamManager_FeaturedLayoutController extends BaseController
{

    public function actionSaveLayouts()
    {
        $this->requirePostRequest();

        $count = craft()->request->getPost('count'); //Number of models
        $type = craft()->request->getPost('fLType');

        for ($i = 0; $i <= $count; $i++) {
            $id = craft()->request->getPost($i . '-id');
            if (craft()->request->getPost($i . '-isArticle')) {
                craft()->teamManager->deleteFeaturedLayout($id);
            } else {
                $model = new TeamManager_FeaturedLayoutModel();

                $model->id = $id;
                $model->index = craft()->request->getPost($i . '-index');
                $model->title = craft()->request->getPost($i . '-title');
                $model->link = craft()->request->getPost($i . '-link');
                $model->image = craft()->request->getPost($i . '-image') == null ? null : craft()->request->getPost($i . '-image')[0];
                $model->type = $type;

                if ($model->validate())
                    craft()->teamManager->saveFeaturedLayout($model);
            }
        }
    }
}