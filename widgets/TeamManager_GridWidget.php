<?php

namespace Craft;

class TeamManager_GridWidget extends BaseWidget
{
    public function getName()
    {
        return Craft::t('Featured Layout - Grid');
    }

    public function getBodyHtml()
    {
        return craft()->templates->render('teamManager/_widgets/Grid');
    }
}