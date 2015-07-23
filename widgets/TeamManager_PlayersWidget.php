<?php

namespace Craft;


class TeamManager_PlayersWidget extends BaseWidget
{

    public function getName()
    {
        return Craft::t('Players Widget');
    }

    public function getBodyHtml()
    {
        return craft()->templates->render('teamManager/_widgets/Players');
    }
}