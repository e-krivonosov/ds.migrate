<?php

namespace Ds\Migrate\Builders;

use Ds\Migrate\Exceptions\HelperException;
use Ds\Migrate\Exceptions\RebuildException;
use Ds\Migrate\Locale;
use Ds\Migrate\Module;
use Ds\Migrate\VersionBuilder;

class UserGroupBuilder extends VersionBuilder
{

    protected function isBuilderEnabled()
    {
        return true;
    }

    protected function initialize()
    {
        $this->setTitle(Locale::getMessage('BUILDER_UserGroupExport1'));
        $this->setDescription(Locale::getMessage('BUILDER_UserGroupExport2'));
        $this->addVersionFields();
    }

    /**
     * @throws HelperException
     * @throws RebuildException
     */
    protected function execute()
    {
        $helper = $this->getHelperManager();

        $this->addField('user_group', [
            'title' => Locale::getMessage('BUILDER_UserGroupExport_user_group'),
            'placeholder' => '',
            'multiple' => 1,
            'value' => [],
            'width' => 250,
            'select' => $this->getUserGroups(),
        ]);

        $userGroups = $this->getFieldValue('user_group');
        if (empty($userGroups)) {
            $this->rebuildField('user_group');
        }

        $userGroups = is_array($userGroups) ? $userGroups : [$userGroups];

        $items = [];
        foreach ($userGroups as $groupId) {
            if ($item = $helper->UserGroup()->exportGroup($groupId)) {
                $fields = $item;
                unset($fields['STRING_ID']);
                $items[] = [
                    'STRING_ID' => $item['STRING_ID'],
                    'FIELDS' => $fields,
                ];
            }
        }

        if (empty($items)) {
            $this->rebuildField('user_group');
        }

        $this->createVersionFile(
            Module::getModuleDir() . '/templates/UserGroupExport.php', [
            'items' => $items,
        ]);

    }

    protected function getUserGroups()
    {
        $helper = $this->getHelperManager();

        $groups = $helper->UserGroup()->getGroups();

        $result = [];
        foreach ($groups as $group) {
            if (!empty($group['STRING_ID'])) {
                $result[] = [
                    'title' => '[' . $group['STRING_ID'] . '] ' . $group['NAME'],
                    'value' => $group['ID'],
                ];
            }
        }

        return $result;

    }
}