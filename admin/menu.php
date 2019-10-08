<?php
global $APPLICATION;

use Bitrix\Main\Loader;
use Ds\Migrate\Locale;

if ($APPLICATION->GetGroupRight('ds.migrate') == 'D') {
    return false;
}

if (!Loader::includeModule('ds.migrate')) {
    return false;
}

try {
    $versionConfig = new Ds\Migrate\VersionConfig();
    $configList = $versionConfig->getList();


    $schemas = [];
    foreach ($configList as $item) {
        $schemas[] = [
            'text' => $item['schema_title'],
            'url' => 'ds_migrate.php?' . http_build_query([
                    'schema' => $item['name'],
                    'lang' => LANGUAGE_ID,
                ]),
        ];
    }

    $items = [];
    foreach ($configList as $item) {
        $items[] = [
            'text' => $item['title'],
            'url' => 'ds_migrate.php?' . http_build_query([
                    'config' => $item['name'],
                    'lang' => LANGUAGE_ID,
                ]),
        ];
    }

    $items[] = [
        'items_id' => 'sp-menu-schema',
        'text' => Locale::getMessage('MENU_SCHEMAS'),
        'items' => $schemas,
    ];

    $aMenu = [
        'parent_menu' => 'global_menu_settings',
        'section' => 'ds_migrate',
        'sort' => 50,
        'text' => Locale::getMessage('MENU_DS_MIGRATE'),
        'icon' => 'sys_menu_icon',
        'page_icon' => 'sys_page_icon',
        'items_id' => 'ds_migrate',
        'items' => $items,
    ];

    return $aMenu;

} catch (Exception $e) {
    $aMenu = [
        'parent_menu' => 'global_menu_settings',
        'section' => 'ds_migrate',
        'sort' => 50,
        'text' => Locale::getMessage('MENU_DS_MIGRATE'),
        'icon' => 'sys_menu_icon',
        'page_icon' => 'sys_page_icon',
        'items_id' => 'ds_migrate',
        'url' => 'ds_migrate.php?' . http_build_query([
                'config' => 'cfg',
                'lang' => LANGUAGE_ID,
            ]),
    ];

    return $aMenu;
} catch (Throwable $e) {
    $aMenu = [
        'parent_menu' => 'global_menu_settings',
        'section' => 'ds_migrate',
        'sort' => 50,
        'text' => Locale::getMessage('MENU_DS_MIGRATE'),
        'icon' => 'sys_menu_icon',
        'page_icon' => 'sys_page_icon',
        'items_id' => 'ds_migrate',
        'url' => 'ds_migrate.php?' . http_build_query([
                'config' => 'cfg',
                'lang' => LANGUAGE_ID,
            ]),
    ];

    return $aMenu;
}