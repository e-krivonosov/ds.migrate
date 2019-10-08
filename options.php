<?php

global $APPLICATION;

use Bitrix\Main\Loader;
use Ds\Migrate\Locale;
use Ds\Migrate\Module;

try {

    if (!Loader::includeModule('ds.migrate')) {
        Throw new Exception('need to install module ds.migrate');
    }

    if ($APPLICATION->GetGroupRight('ds.migrate') == 'D') {
        Throw new Exception(Locale::getMessage("ACCESS_DENIED"));
    }

    Module::checkHealth();

    include __DIR__ . '/admin/includes/options.php';
    include __DIR__ . '/admin/assets/style.php';

} catch (Exception $e) {
    $sperrors = [];
    $sperrors[] = $e->getMessage();

    include __DIR__ . '/admin/includes/errors.php';
    include __DIR__ . '/admin/includes/help.php';
    include __DIR__ . '/admin/assets/style.php';

} catch (Throwable $e) {
    $sperrors = [];
    $sperrors[] = $e->getMessage();

    include __DIR__ . '/admin/includes/errors.php';
    include __DIR__ . '/admin/includes/help.php';
    include __DIR__ . '/admin/assets/style.php';

}