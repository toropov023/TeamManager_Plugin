<?php

namespace Craft;

class TeamManager_TeamModel extends BaseModel{

    protected function defineAttributes()
    {
        return array(
            'id' => AttributeType::Number,
            'sectionId' => AttributeType::Number,
            'teamName'  => AttributeType::String,
            'slug'  => AttributeType::String,
        );
    }

    public function __toString()
    {
        return $this->teamName;
    }
}