<?php

namespace ZendLogger\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\MVC\Controller\AbstractController;

/**
 * @method AbstractController getController()
 */
class Log extends AbstractPlugin
{

    public function __invoke($level, $message = null)
    {
        if (null === $message) {
            $message = $level;
            $level = null;
        }
        $params = [
            'level' => $level,
            'message' => $message,
        ];
        $this->getController()->getEventManager()->trigger(
            'log.message', $this->getController(), $params
        );
    }
}