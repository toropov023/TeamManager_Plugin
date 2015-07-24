<?php

namespace Craft;

class TeamManager_FeaturedLayoutController extends BaseController
{

    public function actionSaveLayouts()
    {
        $this->requirePostRequest();

        $values = craft()->request->getPost('values');
        foreach ($values as $val) {
            if ($val['isArticle'])
                craft()->teamManager->deleteFeaturedLayout($val['id']);
            else {
                $model = new TeamManager_FeaturedLayoutModel();

                $model->index = $val['index'];
                $model->title = $val['title'];
                $model->link = $val['link'];
                $model->image = $val['image'];
                $model->type = $val['type'];

                if ($model->validate())
                    craft()->teamManager->saveFeaturedLayout($model);
            }
        }
    }
}