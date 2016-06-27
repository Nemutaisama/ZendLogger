<?php

namespace ZendLogger;

use Zend\Mvc\MvcEvent;

class Module
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__.'/../../src/'.__NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__.'/../../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array();
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $serviceManager = $e->getApplication()->getServiceManager();
        $eventManager->attach(new ZendLogger($serviceManager));
    }
}