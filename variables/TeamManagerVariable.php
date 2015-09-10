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

    public function renderFormMacro($macro, array $args)
    {
        // Get the current template path
        $originalPath = craft()->path->getTemplatesPath();

        // Point Twig at the CP templates
        craft()->path->setTemplatesPath(craft()->path->getCpTemplatesPath());

        // Render the macro.
        $html = craft()->templates->renderMacro('_includes/forms', $macro, array($args));

        // Restore the original template path
        craft()->path->setTemplatesPath($originalPath);

        return TemplateHelper::getRaw($html);
    }

    public function renderFormCustomMacro($macro, array $args)
    {
        $oldPath = craft()->path->getTemplatesPath();
        $newPath = craft()->path->getPluginsPath().'teammanager/templates';
        craft()->path->setTemplatesPath($newPath);

        $html = craft()->templates->renderMacro('_includes/forms', $macro, array($args));

        craft()->path->setTemplatesPath($oldPath);

        return TemplateHelper::getRaw($html);
    }

    public function getFeaturedLayouts(){
        $arr = array();
        foreach (craft()->teamManager->getFeaturedLayouts() as $val) {
            $inner = array();
            foreach ($val->getAttributes() as $name => $value)
                $inner[$name] = $value;
            $arr[] = $inner;
        }

        return $arr;
    }

    public function getFeaturedLayoutsByType($typeName)
    {
        $type = $typeName == 'slideShow' ? FeaturedLayoutType::slideShow : FeaturedLayoutType::grid;

        $arr = array();
        foreach (craft()->teamManager->getFeaturedLayoutsByType($type) as $val) {
            $inner = array();
            foreach ($val->getAttributes() as $name => $value)
                $inner[$name] = $value;
            $arr[$val->index] = $inner;
        }

        return $arr;
    }

    public function getAllPlayers()
    {
        return craft()->teamManager->getAllPlayers();
    }
    public function getPlayerById($id, $asArray = false)
    {
        $player = craft()->teamManager->getPlayerById($id);
        if($player) {
            if (!$asArray)
                return $player;
            else
                return $player->getAttributes();
        }
        return null;
    }
}