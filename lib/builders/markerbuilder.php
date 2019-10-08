<?php

namespace Ds\Migrate\Builders;

use Ds\Migrate\AbstractBuilder;
use Ds\Migrate\Locale;
use Ds\Migrate\VersionManager;

class MarkerBuilder extends AbstractBuilder
{

    protected function isBuilderEnabled()
    {
        return true;
    }


    protected function initialize()
    {
        $this->setTitle(Locale::getMessage('MARK'));
        $this->setGroup('configurator');

        $this->addField('mark_version', [
            'title' => Locale::getMessage('MARK_FIELD1'),
            'placeholder' => Locale::getMessage('MARK_VERSION'),
            'width' => 250,
        ]);

        $this->addField('mark_status', [
            'title' => Locale::getMessage('MARK_FIELD2'),
            'placeholder' => '',
            'width' => 250,
            'select' => [
                [
                    'title' => Locale::getMessage('MARK_AS_INSTALLED'),
                    'value' => 'installed',
                ],
                [
                    'title' => Locale::getMessage('MARK_AS_NEW'),
                    'value' => 'new',
                ],
            ],
        ]);

    }

    protected function execute()
    {
        $version = $this->getFieldValue('mark_version');
        $status = $this->getFieldValue('mark_status');

        $versionManager = new VersionManager($this->getVersionConfig()->getName());
        $markresult = $versionManager->markMigration($version, $status);

        foreach ($markresult as $val) {
            if ($val['success']) {
                $this->outSuccess($val['message']);
            } else {
                $this->outError($val['message']);
            }
        }

    }
}
