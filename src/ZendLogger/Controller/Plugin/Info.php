<?php

namespace ZendLogger\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\MVC\Controller\AbstractController;

/**
 * @method AbstractController getController()
 */
class Info extends AbstractPlugin
{

    public function __invoke($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getController()->getEventManager()->trigger(
            'log.info', $this->getController(), $params
        );
    }
}