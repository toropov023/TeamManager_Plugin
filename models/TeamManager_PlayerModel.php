<?php

namespace Craft;


class TeamManager_PlayerModel extends BaseModel
{

    protected function defineAttributes()
    {
        return array(
            'name' => array(AttributeType::String, 'required' => true),
            'birth' => array(AttributeType::String, 'required' => true),
            'address' => array(AttributeType::String, 'required' => true),
            'telephone' => array(AttributeType::String, 'required' => true),
            'email' => array(AttributeType::Email, 'required' => true),
            'data' => AttributeType::Mixed
        );
    }

    public function __toString()
    {
        return $this->name;
    }
}