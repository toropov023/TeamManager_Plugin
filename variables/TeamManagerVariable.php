<?php

namespace Craft;

class TeamManagerVariable
{
    public function getAllTeams()
    {
        return craft()->teamManager->getAllTeams();
    }

    public function getTeam($id){
        return craft()->teamManager->getTeam($id);
    }

    public function getTeamByName($name){
        return craft()->teamManager->getTeamByName($name);
    }

    public function getTeamBySlug($slug){
        return craft()->teamManager->getTeamBySlug($slug);
    }

    /**
     * @param TeamManager_TeamModel $team
     */
    public function testGroup($team){
        foreach (craft()->userPermissions->getPermissionsByGroupId($team->getAttribute('groupId')) as $value) {
            echo $value;
        }
    }
}