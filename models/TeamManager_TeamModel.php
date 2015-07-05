<?php

namespace Craft;


class TeamManager_TeamModel extends BaseModel
{

    protected function defineAttributes()
    {
        return array(
            'id' => AttributeType::Number,
            'sectionId' => AttributeType::Number,
            'groupId' => AttributeType::Number,
            'teamName' => AttributeType::String,
            'slug' => AttributeType::String,
            'gender' => array(AttributeType::Enum, 'values' => array(TeamGenderType::male, TeamGenderType::female)),
        );
    }

    public function __toString()
    {
        return $this->teamName;
    }

    public function updateEntryType($fieldLayoutId)
    {
        $types = craft()->sections->getEntryTypesBySectionId($this->sectionId);
        foreach ($types as $type) {
            $record = EntryTypeRecord::model()->findById($type->id);
            $record->setAttribute('fieldLayoutId', $fieldLayoutId);
            $record->save(false);
        }
    }
}