<?php namespace Slayer;

class Factory extends AbstractConfigurableService
{

    /**
    * static instance
    *
    * @var
    */
    protected static $instance;

    /**
    * collection of services
    *
    * @var array $services
    */
    protected $services = [];

    /**
    * allowing this do be public
    * for decendant classes
    *
    * @param array $config
    */
    public function __construct($config)
    {
        parent::__construct($config);
    }

    /**
    * the top level factory should 
    * use this method 
    *
    * @param array $config
    */
    public static function init($config)
    {

        if (null === self::$instance) {
            self::$instance = new self($config);
        }

        return self::$instance;

    }

    /**
    * return the internal instance 
    *
    * @param array $config
    */
    public static function instance()
    {

        return self::$instance;

    }

    /**
    * get a singleton by name
    * 
    * @return mixt
    */
    public function singleton($name)
    {

        if (!isset($this->services[$name]))
            $this->services[$name] = $this->make($name);
            
        return $this->services[$name];
    
    }

    /**
    * set a service
    * 
    * @param mixt
    * @return mixt
    */
    public function setSingleton($name, $service)
    {
        $this->services[$name] = $service;
        return $this;
    }

    /**
    * build a data manager
    *
    */
    public function make($name)
    {

        $config = $this->loadServiceConfigOrFail($name);
        
        $class = array_get($config, 'class') ?: 'Slayer\Factory';
        $config = array_get($config, 'config');

        if (isset($config['services']))
            $config['services'] = $this->configureServices($config['services']);

        return ($config) ? new $class($config) : new $class;

    }

    public function loadServiceConfigOrFail($name)
    {

        $config = $this->getConfig("services.{$name}");

        if (!$config)
            throw new \Exception("Service manager $name not configured", 500); 

        return $config;

    }

    protected function configureServices($services)
    {

        $config = [];

        foreach ($services as $s) {
            $config[$s] = $this->loadServiceConfigOrFail($s);
        }

        return $config;

    }

}