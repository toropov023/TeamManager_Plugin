<?php

namespace Craft;

class TeamManager_TeamRecord extends BaseRecord
{
    public function getTableName()
    {
        return 'teammanager_teams';
    }

    protected function defineAttributes()
    {
        return array(
            'teamName' => AttributeType::String,
            'slug' => AttributeType::String,
            'sectionId' => AttributeType::Number,
            'groupId' => AttributeType::Number,
            'gender' => array(AttributeType::Enum, 'values' => array(TeamGenderType::female, TeamGenderType::male), 'default' => TeamGenderType::male),
        );
    }
}