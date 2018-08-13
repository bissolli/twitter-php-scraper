<?php

namespace Bissolli\TwitterScraper\Models;

use ArrayAccess;
use Bissolli\TwitterScraper\Traits\ArrayLikeTrait;

abstract class ModelAbstract implements ArrayAccess, ModelInterface
{
    use ArrayLikeTrait;

    /**
     * @param array $props
     */
    protected function __construct(array $props = null)
    {
        $this->init($props);
    }

    /**
     * @param array $props
     *
     * @return $this
     */
    final protected function init(array $props)
    {
        foreach ($props as $prop => $value) {
            $this->initProperties($value, $prop);
        }

        return $this;
    }

    /**
     * @var array
     */
    protected static $initPropertiesMap = [];

    /**
     * @return array
     */
    public static function getColumns()
    {
        return array_keys(static::$initPropertiesMap);
    }

    /**
     * @param array $params
     *
     * @return static
     */
    public static function create(array $params = null)
    {
        return new static($params);
    }
}
