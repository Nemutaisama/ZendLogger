<?php

namespace ZendLogger\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\MVC\Controller\AbstractController;

/**
 * @method AbstractController getController()
 */
class Notice extends AbstractPlugin
{

    public function __invoke($message)
    {
        $this->getController()->getEventManager()->trigger(
            'log.notice', $this->getController(), ['message' => $message]
        );
    }
}