<?php

namespace ZendLogger\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\MVC\Controller\AbstractController;

/**
 * @method AbstractController getController()
 */
class Debug extends AbstractPlugin
{

    public function __invoke($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getController()->getEventManager()->trigger(
            'log.debug', $this->getController(), $params
        );
    }
}