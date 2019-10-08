<?php

use Ds\Migrate\Locale;
use Ds\Migrate\Out;
use Ds\Migrate\VersionConfig;
use Ds\Migrate\VersionManager;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$listView = (
    ($_POST["step_code"] == "migration_new") ||
    ($_POST["step_code"] == "migration_list") ||
    ($_POST["step_code"] == "migration_installed")
);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $listView && check_bitrix_sessid('send_sessid')) {

    /** @noinspection PhpIncludeInspection */
    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_js.php");

    /** @var $versionConfig VersionConfig */
    $versionManager = new VersionManager($versionConfig);

    $search = !empty($_POST['search']) ? trim($_POST['search']) : '';
    $search = Ds\Migrate\Locale::convertToUtf8IfNeed($search);

    $webdir = $versionManager->getWebDir();

    if ($_POST["step_code"] == "migration_new") {
        $versions = $versionManager->getVersions([
            'status' => 'new',
            'search' => $search,
        ]);
    } elseif ($_POST["step_code"] == "migration_installed") {
        $versions = $versionManager->getVersions([
            'status' => 'installed',
            'search' => $search,
        ]);

    } else {
        $versions = $versionManager->getVersions([
            'status' => '',
            'search' => $search,
        ]);
    }

    ?>
    <? if (!empty($versions)): ?>
        <table class="sp-list">
            <? foreach ($versions as $aItem): ?>
                <tr>
                    <td class="sp-list-l">
                        <? if ($aItem['status'] == 'new'): ?>
                            <input disabled="disabled"
                                   onclick="migrationExecuteStep('migration_execute', {version: '<?= $aItem['version'] ?>', action: 'up'});"
                                   value="<?= Locale::getMessage('UP') ?>" type="button">
                        <? endif ?>
                        <? if ($aItem['status'] == 'installed'): ?>
                            <input disabled="disabled"
                                   onclick="migrationExecuteStep('migration_execute', {version: '<?= $aItem['version'] ?>', action: 'down'});"
                                   value="<?= Locale::getMessage('DOWN') ?>" type="button">
                        <? endif ?>
                    </td>
                    <td class="sp-list-r">
                        <? if ($aItem['status'] != 'unknown' && $webdir): ?>
                            <? $href = '/bitrix/admin/fileman_file_view.php?' . http_build_query([
                                    'lang' => LANGUAGE_ID,
                                    'site' => SITE_ID,
                                    'path' => $webdir . '/' . $aItem['version'] . '.php',
                                ]) ?>
                            <a class="sp-item-<?= $aItem['status'] ?>" href="<?= $href ?>" target="_blank"
                               title=""><?= $aItem['version'] ?></a>
                        <? else: ?>
                            <span class="sp-item-<?= $aItem['status'] ?>"><?= $aItem['version'] ?></span>
                        <? endif ?>

                        <? if ($aItem['modified']): ?>
                            <span class="sp-modified"
                                  title="<?= Locale::getMessage('MODIFIED_VERSION') ?>"><?= Locale::getMessage('MODIFIED_LABEL') ?></span>
                        <? endif; ?>

                        <? if ($aItem['tag']): ?>
                            <span class="sp-tag" title="<?= Locale::getMessage('TAG') ?>"><?= $aItem['tag'] ?></span>
                        <? endif; ?>
                        <? if (!empty($aItem['description'])): ?>
                            <? Out::out($aItem['description']) ?>
                        <? endif ?>
                    </td>
                </tr>
            <? endforeach ?>
        </table>
    <? else: ?>
        <?= Locale::getMessage('LIST_EMPTY') ?>
    <? endif ?>
    <?
    /** @noinspection PhpIncludeInspection */
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin_js.php");
    die();

}