<?php

namespace ZendLogger;

use Zend\EventManager\EventManagerInterface;

trait LoggerTrait
{
    /**
     * @return EventManagerInterface
     */
    abstract public function getEventManager();

    public function log($level, $message = null, $context = [])
    {
        if (null === $message) {
            $message = $level;
            $level = null;
        }
        $params = [
            'level'   => $level,
            'message' => $message,
            'context' => $context,
        ];
        $this->getEventManager()->trigger('log.message', $this, $params);
    }

    public function emergency($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getEventManager()->trigger('log.emergency', $this, $params);
    }

    public function alert($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getEventManager()->trigger('log.alert', $this, $params);
    }

    public function critical($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getEventManager()->trigger('log.critical', $this, $params);
    }

    public function error($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getEventManager()->trigger('log.error', $this, $params);
    }

    public function warning($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getEventManager()->trigger('log.warning', $this, $params);
    }

    public function notice($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getEventManager()->trigger('log.notice', $this, $params);
    }

    public function info($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getEventManager()->trigger('log.info', $this, $params);
    }

    public function debug($message, $context = [])
    {
        $params = [
            'message' => $message,
            'context' => $context,
        ];
        $this->getEventManager()->trigger('log.debug', $this, $params);
    }

}