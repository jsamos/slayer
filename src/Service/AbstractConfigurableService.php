<?php namespace Dws\Slender\Api\Service;

abstract class AbstractConfigurableService
{

    /**
    * configuration data
    *
    * @var array
    */
    protected $config;

    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
    * get the client configuration [by name]
    *
    * @param string $name (optional)
    * @return array
    */
    public function getConfig($name = null)
    {
        if (!is_null($name)) return array_get($this->config, $name);
        return $this->config;
    }

    /**
    * set the resource by name
    *
    * @param string $name
    * @param array $val
    * @return Dws\Slender\Api\Service\AbstractConfigurableService
    */
    public function setConfig($name, $val)
    {            
        array_set($this->config, $name, $val);
        return $this;
    }

}