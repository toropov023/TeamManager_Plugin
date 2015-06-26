<?php

namespace Craft;

class TeamManagerService extends BaseApplicationComponent
{
    public function newTeam($attributes = array())
    {
        $model = new TeamManager_TeamModel();
        $model->setAttributes($attributes);

        return $model;
    }

    public function saveTeam(TeamManager_TeamModel &$model)
    {
        $teamRecord = TeamManager_TeamRecord::model()->findByAttributes(array('id' => $model->getAttribute('id')));

        if ($teamRecord) {
            foreach ($model->getAttributes() as $key => $value) {
                $teamRecord->setAttribute($key, $value);
            }
        } else {
            $teamRecord = new TeamManager_TeamRecord();
            foreach ($model->getAttributes() as $key => $value) {
                $teamRecord->setAttribute($key, $value);
            }
        }

        return $teamRecord->save();
    }

    public function getTeam($id)
    {
        $teamModel = null;

        $teamRecord = TeamManager_TeamRecord::model()->findByAttributes(array('id' => $id));

        if ($teamRecord)
            $teamModel = TeamManager_TeamModel::populateModel($teamRecord);

        return $teamModel;
    }

    public function getTeamByName($name){
        $teamModel = null;

        $teamRecord = TeamManager_TeamRecord::model()->findByAttributes(array('teamName' => $name));

        if ($teamRecord)
            $teamModel = TeamManager_TeamModel::populateModel($teamRecord);

        return $teamModel;
    }

    public function getTeamBySlug($slug){
        $teamModel = null;

        $teamRecord = TeamManager_TeamRecord::model()->findByAttributes(array('slug' => $slug));

        if ($teamRecord)
            $teamModel = TeamManager_TeamModel::populateModel($teamRecord);

        return $teamModel;
    }

    public function getAllTeams()
    {
        $records = TeamManager_TeamRecord::model()->findAll(array('order' => 't.id'));
        return TeamManager_TeamModel::populateModels($records, 'id');
    }

    public function deleteTeam($id)
    {
        $teamRecord = TeamManager_TeamRecord::model()->findByAttributes(array('id' => $id));

        if ($teamRecord) {
            $teamRecord->delete();
            return true;
        } else
            return false;
    }
}