<?php

namespace Ds\Migrate\Builders\Traits;

use Ds\Migrate\Exceptions\HelperException;
use Ds\Migrate\HelperManager;

/**
 * Trait HlblocksStructureTrait
 * @package Ds\Migrate\Builders\Traits
 *
 * @method HelperManager getHelperManager()
 */
trait HlblocksStructureTrait
{

    /**
     * @throws HelperException
     * @return array
     */
    protected function getHlblocksStructure()
    {
        $res = [];
        $helper = $this->getHelperManager();
        $hlblocks = $helper->Hlblock()->getHlblocks();
        foreach ($hlblocks as $hlblock) {
            $res[] = [
                'title' => $hlblock['NAME'],
                'value' => $hlblock['ID'],
            ];
        }
        return $res;
    }

    /**
     * @param $hlblockName
     * @throws HelperException
     * @return array
     */
    protected function getHlblockFieldsCodes($hlblockName)
    {
        $res = [];
        $helper = $this->getHelperManager();
        $items = $helper->Hlblock()->getFields($hlblockName);
        foreach ($items as $item) {
            if (!empty($item['FIELD_NAME'])) {
                $res[] = $item['FIELD_NAME'];
            }
        }
        return $res;
    }
}