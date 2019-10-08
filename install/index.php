<?php

use Ds\Migrate\Locale;

Class ds_migrate extends CModule
{
    var $MODULE_ID = "ds.migrate";

    var $MODULE_NAME;
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;

    var $MODULE_GROUP_RIGHTS = "Y";

    function ds_migrate()
    {
        $arModuleVersion = [];

        include(__DIR__ . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        include(__DIR__ . '/../locale/ru.php');

        $this->MODULE_NAME = GetMessage("DS_MIGRATE_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("DS_MIGRATE_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = GetMessage("DS_MIGRATE_PARTNER_NAME");
        $this->PARTNER_URI = GetMessage("DS_MIGRATE_PARTNER_URI");
    }

    function DoInstall()
    {
        RegisterModule($this->MODULE_ID);

        CopyDirFiles(__DIR__ . "/admin", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
        $this->installGadgets();
    }

    function DoUninstall()
    {
        DeleteDirFiles(__DIR__ . "/admin", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
        $this->unnstallGadgets();

        UnRegisterModule($this->MODULE_ID);
    }

    function installGadgets()
    {
        CopyDirFiles(__DIR__ . "/gadgets", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/gadgets", true, true);
    }

    function unnstallGadgets()
    {
        DeleteDirFiles(__DIR__ . "/gadgets", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/gadgets");
    }

    function GetModuleRightList()
    {
        $arr = [
            "reference_id" => ["D", "W"],
            "reference" => [
                "[D] " . Locale::getMessage("RIGHT_D"),
                "[W] " . Locale::getMessage("RIGHT_W"),
            ],
        ];
        return $arr;
    }
}
