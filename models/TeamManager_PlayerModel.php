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
            'data' => AttributeType::Mixed,
            //extra data
            'previousClub' => AttributeType::String,
            'previousLeague' => AttributeType::String,
            'medicalIssues' => AttributeType::String,
            'parentName1' => array(AttributeType::String, 'required' => true),
            'parentName2' => AttributeType::String,
            'parentsAddress' => array(AttributeType::String, 'required' => true),
            'parentTelephone1' => array(AttributeType::String, 'required' => true),
            'parentTelephone2' => AttributeType::String,
            'parentEmail1' => array(AttributeType::Email, 'required' => true),
            'parentEmail2' => AttributeType::Email
        );
    }

    public function __toString()
    {
        return $this->name;
    }
}