<?php

namespace Ds\Migrate;

use Ds\Migrate\Exchange\HlblockElementsExport;
use Ds\Migrate\Exchange\HlblockElementsImport;
use Ds\Migrate\Exchange\IblockElementsExport;
use Ds\Migrate\Exchange\IblockElementsImport;


class ExchangeManager
{
    protected $exchangeEntity;

    public function __construct(ExchangeEntity $exchangeEntity)
    {
        $this->exchangeEntity = $exchangeEntity;
    }

    /**
     * @throws Exceptions\ExchangeException
     * @return IblockElementsExport
     */
    public function IblockElementsExport()
    {
        return new IblockElementsExport($this->exchangeEntity);
    }

    /**
     * @throws Exceptions\ExchangeException
     * @return IblockElementsImport
     */
    public function IblockElementsImport()
    {
        return new IblockElementsImport($this->exchangeEntity);
    }

    /**
     * @throws Exceptions\ExchangeException
     * @return HlblockElementsImport
     */
    public function HlblockElementsImport()
    {
        return new HlblockElementsImport($this->exchangeEntity);
    }

    /**
     * @throws Exceptions\ExchangeException
     * @return HlblockElementsExport
     */
    public function HlblockElementsExport()
    {
        return new HlblockElementsExport($this->exchangeEntity);
    }
}
