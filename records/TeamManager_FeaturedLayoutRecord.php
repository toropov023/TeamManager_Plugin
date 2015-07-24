<?php

namespace Craft;

class TeamManager_FeaturedLayoutRecord extends BaseRecord
{
    public function getTableName()
    {
        return 'teammanager_featuredLayout';
    }

    protected function defineAttributes()
    {
        return array(
            'index' => AttributeType::Number,
            'title' => AttributeType::String,
            'link' => AttributeType::String,
            'image' => array(static::BELONGS_TO, 'AssetFileRecord'),
            'type' => array(AttributeType::Enum, 'values' => array(FeaturedLayoutType::slideShow, FeaturedLayoutType::grid))
        );
    }
}