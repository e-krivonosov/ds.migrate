<?php

namespace Ds\Migrate\Helpers;

use Ds\Migrate\Helper;
use Ds\Migrate\Helpers\Traits\Iblock\IblockElementTrait;
use Ds\Migrate\Helpers\Traits\Iblock\IblockPropertyTrait;
use Ds\Migrate\Helpers\Traits\Iblock\IblockSectionTrait;
use Ds\Migrate\Helpers\Traits\Iblock\IblockTrait;
use Ds\Migrate\Helpers\Traits\Iblock\IblockTypeTrait;

class IblockHelper extends Helper
{
    use IblockPropertyTrait;
    use IblockElementTrait;
    use IblockSectionTrait;
    use IblockTypeTrait;
    use IblockTrait;

    /**
     * IblockHelper constructor.
     */
    public function isEnabled()
    {
        return $this->checkModules(['iblock']);
    }

}