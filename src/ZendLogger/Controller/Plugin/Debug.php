<?php

namespace ZendLogger\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\MVC\Controller\AbstractController;

/**
 * @method AbstractController getController()
 */
class Debug extends AbstractPlugin
{

    public function __invoke($message)
    {
        $this->getController()->getEventManager()->trigger(
            'log.debug', $this->getController(), ['message' => $message]
        );
    }
}