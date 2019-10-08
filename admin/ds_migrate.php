<?php

/** @noinspection PhpIncludeInspection */

use Bitrix\Main\Loader;
use Ds\Migrate\Locale;
use Ds\Migrate\Module;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/** @global $APPLICATION CMain */
global $APPLICATION;

try {
    if (!Loader::includeModule('ds.migrate')) {
        Throw new Exception('need to install module ds.migrate');
    }

    if ($APPLICATION->GetGroupRight('ds.migrate') == 'D') {
        Throw new Exception(Locale::getMessage("ACCESS_DENIED"));
    }

    Module::checkHealth();

    include __DIR__ . '/includes/interface.php';

    /** @noinspection PhpIncludeInspection */
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");

} catch (Exception $e) {
    /** @noinspection PhpIncludeInspection */
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

    $sperrors = [];
    $sperrors[] = $e->getMessage();

    include __DIR__ . '/includes/errors.php';
    include __DIR__ . '/includes/help.php';
    include __DIR__ . '/assets/style.php';

    /** @noinspection PhpIncludeInspection */
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
} catch (Throwable $e) {
    /** @noinspection PhpIncludeInspection */
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

    $sperrors = [];
    $sperrors[] = $e->getMessage();

    include __DIR__ . '/includes/errors.php';
    include __DIR__ . '/includes/help.php';
    include __DIR__ . '/assets/style.php';

    /** @noinspection PhpIncludeInspection */
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
}