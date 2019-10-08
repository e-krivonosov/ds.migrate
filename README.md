# Миграции для разработчиков (1С-Битрикс) #
[![Latest Stable Version](https://poser.pugx.org/andreyryabin/ds.migrate/v/stable.svg)](https://packagist.org/packages/andreyryabin/ds.migrate/)
[![Total Downloads](https://img.shields.io/packagist/dt/andreyryabin/ds.migrate.svg?style=flat)](https://packagist.org/packages/andreyryabin/ds.migrate)

Помогает переносить изменения между нескольким копиями проекта.

Все изменения для базы данных пишутся в файлы миграций, эти файлы, как и весь код проекта, хранятся в системе контроля версий (например git) и попадают в копии разработчиков, после чего им необходимо выполнить установку новых миграций, чтобы обновить бд.

Работать можно как через консоль, так и через админку.

* Маркетплейс: [http://marketplace.1c-bitrix.ru/solutions/ds.migrate/](http://marketplace.1c-bitrix.ru/solutions/ds.migrate/)
* Composer: [https://packagist.org/packages/andreyryabin/ds.migrate](https://packagist.org/packages/andreyryabin/ds.migrate)
* Документация: [https://github.com/andreyryabin/ds.migrate/wiki](https://github.com/andreyryabin/ds.migrate/wiki)
* Материалы: [https://dev.1c-bitrix.ru/community/webdev/user/39653/blog/](https://dev.1c-bitrix.ru/community/webdev/user/39653/blog/)
* Группа в телеграм: [https://t-do.ru/ds_migrate_bitrix](https://t-do.ru/ds_migrate_bitrix)

Особая благодарность
-------------------------
Самой лучшей IDE на свете!\
[![Phpstorm](https://raw.githubusercontent.com/wiki/andreyryabin/ds.migrate/assets/phpstorm.png)](https://www.jetbrains.com/?from=ds.migrate)

А также всем помощникам!\
[https://github.com/andreyryabin/ds.migrate/blob/master/contributors.txt](https://github.com/andreyryabin/ds.migrate/blob/master/contributors.txt)


Установка через composer
-------------------------
Пример вашего composer.json с установкой модуля в local/modules/
```
{
  "extra": {
    "installer-paths": {
      "local/modules/{$name}/": ["type:bitrix-module"]
    }
  },
  "require": {
    "andreyryabin/ds.migrate": "dev-master"
  },
}

```

Консоль
-------------------------
Для работы через консоль используется скрипт 
/bitrix/modules/ds.migrate/tools/migrate.php

Можно запускать его напрямую или сделать алиас, 
создав файл в корне проекта, bin/migrate и прописав в нем:

```
#!/usr/bin/env php
<?php

$_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__);
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/ds.migrate/tools/migrate.php';

```

Примеры команд
-------------------------
* php bin/migrate add (создать новую миграцию)
* php bin/migrate ls  (показать список миграций )
* php bin/migrate up (накатить все миграции) 
* php bin/migrate up [version] (накатить выбранную миграцию)
* php bin/migrate down (откатить все миграции)
* php bin/migrate down [version] (откатить выбранную миграцию)

Все команды: https://github.com/andreyryabin/ds.migrate/blob/master/commands.txt


Тегирование миграций
-------------------------
При установке новых миграций их можно пометить произвольным тегом: 
php bin/migrate up --add-tag=release001

Это бывает удобно в случае отката релиза, когда требуется вернуть его в начальное состояние, 
при условии что написан код отката 

Откат миграций по тегу:
php bin/migrate down --tag=release001
