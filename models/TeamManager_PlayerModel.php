<?php

namespace Craft;


class TeamManager_PlayerModel extends BaseModel
{

    protected function defineAttributes()
    {
        return array(
            'id' => AttributeType::Number,
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
            'parentEmail2' => AttributeType::Email,
            'shirtSize' => array(AttributeType::String, 'required' => true),
            'shortsSize' => array(AttributeType::String, 'required' => true)
        );
    }

    public function validate($attributes = null, $clearErrors = true)
    {
        $arr = explode("/", $this->birth);

        if (count($arr) != 3) {
            $this->addError('birth', Craft::t('Incorrect date format, please use DD/MM/YY date format'));
        } else {
            if (strlen($arr[0]) != 2 || $arr[0] < 1 || $arr[0] > 31 || strlen($arr[1]) != 2 || $arr[1] < 1 || $arr[1] > 12 || strlen($arr[2]) != 2 || ($arr[2] < 96 && $arr[2] > 14) || $arr[2] < 0) {
                $this->addError('birth', Craft::t('Incorrect date format, please use DD/MM/YY date format'));
            }
        }

        return parent::validate($attributes, false);
    }

    public function __toString()
    {
        return $this->name;
    }
}