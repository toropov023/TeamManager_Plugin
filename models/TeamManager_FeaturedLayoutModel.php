<?php

namespace Craft;

class TeamManager_FeaturedLayoutModel extends BaseModel
{
    protected function defineAttributes()
    {
        return array(
            'id' => AttributeType::Number,
            'index' => AttributeType::Number,
            'title' => AttributeType::String,
            'link' => AttributeType::String,
            'image' => AttributeType::Number,
            'type' => array(AttributeType::Enum, 'values' => array(FeaturedLayoutType::slideShow, FeaturedLayoutType::grid))
        );
    }
}