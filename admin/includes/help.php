<?php

use Ds\Migrate\Locale;

global $APPLICATION;
$isSettinsPage = strpos($APPLICATION->GetCurPage(), 'settings.php');
?>
<div class="sp-group">
    <div class="sp-group-row2">
        <div class="sp-block">
            <? if ($isSettinsPage): ?>
                <a href="/bitrix/admin/ds_migrate.php?config=cfg&lang=<?= LANGUAGE_ID ?>"><?= Locale::getMessage('GOTO_MIGRATION') ?></a>
            <? else: ?>
                <a href="/bitrix/admin/settings.php?mid=ds.migrate&mid_menu=1&lang=<?= LANGUAGE_ID ?>"><?= Locale::getMessage('GOTO_OPTIONS') ?></a>
            <? endif; ?>
        </div>
        <div class="sp-block">
            <div style="margin-bottom: 10px;">
                <?= Locale::getMessage('LINK_MP') ?> <br/>
                <a href="http://marketplace.1c-bitrix.ru/solutions/ds.migrate/" target="_blank">http://marketplace.1c-bitrix.ru/solutions/ds.migrate/</a>
            </div>
            <div style="margin-bottom: 10px;">
                <?= Locale::getMessage('LINK_COMPOSER') ?>
                <br/>
                <a href="https://packagist.org/packages/andreyryabin/ds.migrate" target="_blank">https://packagist.org/packages/andreyryabin/ds.migrate</a>
            </div>
            <div style="margin-bottom: 10px;">
                <?= Locale::getMessage('LINK_DOC') ?>
                <br/>
                <a href="https://github.com/andreyryabin/ds.migrate/wiki" target="_blank">https://github.com/andreyryabin/ds.migrate/wiki</a>
            </div>
            <div style="margin-bottom: 10px;">
                <?= Locale::getMessage('LINK_ARTICLES') ?>
                <br/>
                <a href="https://dev.1c-bitrix.ru/community/webdev/user/39653/blog/" target="_blank">https://dev.1c-bitrix.ru/community/webdev/user/39653/blog/</a>
            </div>
            <div style="margin-bottom: 10px;">
                <?= Locale::getMessage('LINK_TELEGRAM') ?>
                <br/>
                <a href="tg://resolve?domain=ds_migrate_bitrix">tg://resolve?domain=ds_migrate_bitrix</a>
            </div>

        </div>
    </div>
</div>