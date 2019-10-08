<?php

namespace Ds\Migrate;

use Ds\Migrate\Exceptions\HelperException;
use Ds\Migrate\Helpers\AdminIblockHelper;
use Ds\Migrate\Helpers\AgentHelper;
use Ds\Migrate\helpers\DeliveryServiceHelper;
use Ds\Migrate\Helpers\EventHelper;
use Ds\Migrate\Helpers\FormHelper;
use Ds\Migrate\Helpers\HlblockHelper;
use Ds\Migrate\Helpers\IblockHelper;
use Ds\Migrate\Helpers\LangHelper;
use Ds\Migrate\Helpers\MedialibHelper;
use Ds\Migrate\Helpers\OptionHelper;
use Ds\Migrate\Helpers\SiteHelper;
use Ds\Migrate\Helpers\SqlHelper;
use Ds\Migrate\Helpers\UserGroupHelper;
use Ds\Migrate\Helpers\UserOptionsHelper;
use Ds\Migrate\Helpers\UserTypeEntityHelper;

/**
 * @method IblockHelper             Iblock()
 * @method HlblockHelper            Hlblock()
 * @method AgentHelper              Agent()
 * @method EventHelper              Event()
 * @method LangHelper               Lang()
 * @method SiteHelper               Site()
 * @method UserOptionsHelper        UserOptions()
 * @method UserTypeEntityHelper     UserTypeEntity()
 * @method UserGroupHelper          UserGroup()
 * @method OptionHelper             Option()
 * @method FormHelper               Form()
 * @method DeliveryServiceHelper    DeliveryService()
 * @method SqlHelper                Sql()
 * @method MedialibHelper           Medialib()
 * @method AdminIblockHelper        AdminIblock()
 */
class HelperManager
{

    private $cache = [];

    private static $instance = null;

    private $registered = [];

    /**
     * @return HelperManager
     */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @param $name
     * @param $arguments
     * @throws HelperException
     * @return Helper
     */
    public function __call($name, $arguments)
    {
        return $this->callHelper($name);
    }

    public function registerHelper($name, $class)
    {
        $this->registered[$name] = $class;
    }

    /**
     * @param $name
     * @throws HelperException
     * @return Helper
     */
    protected function callHelper($name)
    {
        if (isset($this->cache[$name])) {
            return $this->cache[$name];
        }

        $helperClass = '\\Ds\\Migrate\\Helpers\\' . $name . 'Helper';
        if (class_exists($helperClass)) {
            $this->cache[$name] = new $helperClass;
            return $this->cache[$name];
        }

        if (isset($this->registered[$name])) {
            $helperClass = $this->registered[$name];
            if (class_exists($helperClass)) {
                $this->cache[$name] = new $helperClass;
                return $this->cache[$name];
            }
        }

        Throw new HelperException("Helper $name not found");
    }
}
