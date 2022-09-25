<?php

namespace DI;

use Closure;

/**
 * Container class managing shared services
 */
class DependencyInjection 
{   
    protected static ?DependencyInjection $instance = null;

    /**
     * List with services added to DI
     * 
     * @param string $serviceName
     * @param $service
     */
    private array $services = [];

    public function setService(string $serviceName, $service): void
    {
        $this->services[$serviceName] = $service;
    }

    /**
     * Getting an instance of the service
     * 
     * @param string $serviceName
     */
    public function getService(string $serviceName)
    {
        $service = $this->services[$serviceName];

        switch (gettype($service)) {
            case 'object':
                if ($service instanceof Closure) {
                    return $service();
                } else {
                    return $service;
                }
            case 'array':
                return $service;
            default:
                throw new \Exception("Unknown service type " . gettype($service));
            break;
        }
    }

    /**
     * Get DependencyInjection class instance
     */
    public static function getDI(): DependencyInjection
    {
        if (is_null(self::$instance)) {
            self::$instance = new DependencyInjection();
        }

        return self::$instance;
    }

}