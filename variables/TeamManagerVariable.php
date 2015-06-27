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

    public function getTeamGenderTypes(){
        return TeamGenderType::getConstants();
    }
}