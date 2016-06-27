<?php

namespace ZendLogger\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\MVC\Controller\AbstractController;

/**
 * @method AbstractController getController()
 */
class Error extends AbstractPlugin
{

    public function __invoke($message)
    {
        $this->getController()->getEventManager()->trigger(
            'log.error', $this->getController(), ['message' => $message]
        );
    }
}