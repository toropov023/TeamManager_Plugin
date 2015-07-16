<?php

namespace Craft;

class TeamManager_PlayerRecord extends BaseRecord
{
    public function getTableName()
    {
        return 'teammanager_players';
    }

    protected function defineAttributes()
    {
        return array(
            'name' => AttributeType::String,
            'birth' => AttributeType::String,
            'address' => AttributeType::String,
            'telephone' => AttributeType::String,
            'email' => AttributeType::Email,
            'data' => AttributeType::Mixed
        );
    }
}