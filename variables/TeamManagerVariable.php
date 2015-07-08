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

    public function getAssetElementType(){
        return craft()->elements->getElementType(ElementType::Asset);
    }

    public function getElementsById($ids){
        if(is_array($ids)){
            $arr = array();
            foreach($ids as $id)
                $arr[] = craft()->elements->getElementById($id);
            return $arr;
        } else{
            return array(craft()->elements->getElementById($ids));
        }
    }
}