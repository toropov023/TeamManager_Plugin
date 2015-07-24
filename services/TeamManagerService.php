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

        if (!$teamRecord)
            $teamRecord = new TeamManager_TeamRecord();

        foreach ($model->getAttributes() as $key => $value)
            $teamRecord->setAttribute($key, $value);

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

    public function getTeamByName($name)
    {
        $teamModel = null;

        $teamRecord = TeamManager_TeamRecord::model()->findByAttributes(array('teamName' => $name));

        if ($teamRecord)
            $teamModel = TeamManager_TeamModel::populateModel($teamRecord);

        return $teamModel;
    }

    public function getTeamBySlug($slug)
    {
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


    //Players
    public function savePlayer(TeamManager_PlayerModel &$model)
    {
        $teamRecord = TeamManager_PlayerRecord::model()->findByAttributes(array('id' => $model->getAttribute('id')));

        if (!$teamRecord)
            $teamRecord = new TeamManager_PlayerRecord();

        foreach ($model->getAttributes() as $key => $value)
            $teamRecord->setAttribute($key, $value);

        return $teamRecord->save();
    }

    public function getPlayer($id)
    {
        $teamModel = null;

        $teamRecord = TeamManager_PlayerRecord::model()->findByAttributes(array('id' => $id));

        if ($teamRecord)
            $teamModel = TeamManager_PlayerModel::populateModel($teamRecord);

        return $teamModel;
    }

    public function getPlayerByName($name)
    {
        $teamModel = null;

        $teamRecord = TeamManager_PlayerRecord::model()->findByAttributes(array('name' => $name));

        if ($teamRecord)
            $teamModel = TeamManager_PlayerModel::populateModel($teamRecord);

        return $teamModel;
    }

    public function getAllPlayers()
    {
        $records = TeamManager_PlayerRecord::model()->findAll(array('order' => 't.id'));
        return TeamManager_PlayerModel::populateModels($records, 'id');
    }

    public function deletePlayer($id)
    {
        $record = TeamManager_PlayerRecord::model()->findByAttributes(array('id' => $id));

        if ($record) {
            $record->delete();
            return true;
        } else
            return false;
    }

    //Featured layouts
    public function saveFeaturedLayout(TeamManager_FeaturedLayoutModel &$model)
    {
        $record = TeamManager_FeaturedLayoutRecord::model()->findByAttributes(array('id' => $model->getAttribute('id')));

        if (!$record)
            $record = new TeamManager_FeaturedLayoutRecord();

        foreach ($model->getAttributes() as $key => $value)
            $record->setAttribute($key, $value);

        return $record->save();
    }

    public function deleteFeaturedLayout($id)
    {
        $record = TeamManager_FeaturedLayoutRecord::model()->findByAttributes(array('id' => $id));

        if ($record) {
            $record->delete();
            return true;
        } else
            return false;
    }

    public function getFeaturedLayouts()
    {
        $records = TeamManager_FeaturedLayoutRecord::model()->findAll(array('order' => 't.id'));
        return TeamManager_FeaturedLayoutModel::populateModels($records, 'id');
    }
    public function getFeaturedLayoutsByType($type)
    {
        $records = TeamManager_FeaturedLayoutRecord::model()->findAllByAttributes(array('type' => $type));
        return TeamManager_FeaturedLayoutModel::populateModels($records, 'index');
    }
}