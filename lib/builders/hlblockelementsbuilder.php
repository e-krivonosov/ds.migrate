<?php

namespace Ds\Migrate\Builders;

use Ds\Migrate\Builders\Traits\HlblocksStructureTrait;
use Ds\Migrate\Exceptions\ExchangeException;
use Ds\Migrate\Exceptions\HelperException;
use Ds\Migrate\Exceptions\RebuildException;
use Ds\Migrate\Exceptions\RestartException;
use Ds\Migrate\Locale;
use Ds\Migrate\Module;
use Ds\Migrate\VersionBuilder;

class HlblockElementsBuilder extends VersionBuilder
{
    use HlblocksStructureTrait;

    /**
     * @return bool
     */
    protected function isBuilderEnabled()
    {
        return $this->getHelperManager()->Hlblock()->isEnabled();
    }

    protected function initialize()
    {
        $this->setTitle(Locale::getMessage('BUILDER_HlblockElementsExport1'));
        $this->setDescription(Locale::getMessage('BUILDER_HlblockElementsExport2'));
        $this->addVersionFields();
    }

    /**
     * @throws RebuildException
     * @throws ExchangeException
     * @throws RestartException
     * @throws HelperException
     */
    protected function execute()
    {
        $this->addField('hlblock_id', [
            'title' => Locale::getMessage('BUILDER_HlblockElementsExport_HlblockId'),
            'placeholder' => '',
            'width' => 250,
            'select' => $this->getHlblocksStructure(),
        ]);

        $hlblockId = $this->getFieldValue('hlblock_id');
        if (empty($hlblockId)) {
            $this->rebuildField('hlblock_id');
        }

        if (!isset($this->params['~version_name'])) {
            $this->params['~version_name'] = $this->getVersionName();
        }

        $versionName = $this->params['~version_name'];

        $this->getExchangeManager()
            ->HlblockElementsExport()
            ->setLimit(20)
            ->setExportFields(
                $this->getHlblockFieldsCodes($hlblockId)
            )
            ->setHlblockId($hlblockId)
            ->setExchangeFile(
                $this->getVersionResourceFile($versionName, 'hlblock_elements.xml')
            )
            ->execute();

        $this->createVersionFile(
            Module::getModuleDir() . '/templates/HlblockElementsExport.php',
            [
                'version' => $versionName,
            ]
        );

        unset($this->params['~version_name']);
    }
}