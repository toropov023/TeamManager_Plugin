<?php

namespace Craft;

class TeamManager_SlideShowWidget extends BaseWidget
{
    public function getName()
    {
        return Craft::t('Featured Layout - Slide Show');
    }

    public function getBodyHtml()
    {
        //TODO better grab some settings
        return craft()->templates->render('teamManager/_widgets/SlideShow');
    }
}