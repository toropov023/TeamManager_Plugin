<?php
namespace Craft;

class TeamManager_FeaturedEntryFieldType extends BaseFieldType
{
    public function getName()
    {
        return Craft::t('Featured Entry');
    }

    public function defineContentAttribute()
    {
        return AttributeType::Bool;
    }

    public function getInputHtml($name, $value)
    {
        return craft()->templates->render('teammanager/_fieldtypes/featuredEntry', array(
            'name' => $name,
            'value' => $value,
        ));
    }
}