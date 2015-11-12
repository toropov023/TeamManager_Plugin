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
            'description' => array(AttributeType::Mixed, 'column' => ColumnType::MediumText),
            'thumbnail' => array(static::BELONGS_TO, 'AssetFileRecord'),
            'images' => AttributeType::Mixed,
            'calendar' => AttributeType::String
        );
    }
}