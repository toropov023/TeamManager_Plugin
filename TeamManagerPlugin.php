<?php

namespace Craft;

class TeamManagerPlugin extends BasePlugin
{
    public function getName()
    {
        return 'Team Manager';
    }

    public function getVersion()
    {
        return '0.1';
    }

    public function getDeveloper()
    {
        return 'Kirill Toropov';
    }

    public function getDeveloperUrl()
    {
        return 'http://toro.ninja/';
    }

    public function hasCpSection()
    {
        return true;
    }

    public function registerCpRoutes()
    {
        return array(
            'teammanager\/teams\/new' => 'teammanager/teams/_edit',
            'teammanager\/teams\/(?P<teamId>\d+)' => 'teammanager/teams/_edit',
        );
    }

    public function onAfterInstall()
    {

    }

    public function init()
    {
        parent::init();

        craft()->on('sections.onSaveEntryType', function (Event $event) {
            if ($event->params['entryType']->handle == 'structure')
                foreach (craft()->teamManager->getAllTeams() as $team)
                    $team->updateEntryType($event->params['entryType']->fieldLayoutId);
        });
    }
}