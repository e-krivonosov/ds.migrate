<?php

namespace Ds\Migrate\Exchange\Helpers;

use Ds\Migrate\HelperManager;

class ExchangeHelper
{

    public function isEnabled()
    {
        return true;
    }

    protected function getHelperManager()
    {
        return HelperManager::getInstance();
    }
}