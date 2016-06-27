<?php
namespace ZendLogger;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventInterface;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class ZendLogger
    implements ListenerAggregateInterface, ServiceLocatorAwareInterface
{

    /** @var LoggerInterface */
    private $logger;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();


    /**
     * @param ServiceLocatorInterface $sl
     */
    public function __construct(ServiceLocatorInterface $sl)
    {
        $this->serviceLocator = $sl;
        $config = $sl->get('config');
        $this->logger = $this->getServiceLocator()->get($config['ZendLogger']);
    }

    /**
     * @param ServiceLocatorInterface $sl
     *
     * @return $this
     */
    public function setServiceLocator(ServiceLocatorInterface $sl)
    {
        $this->serviceLocator = $sl;

        return $this;
    }

    /**
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents = $events->getSharedManager();
        $this->listeners[] = $sharedEvents->attach(
            '*', 'log.emergency', array($this, 'onEmergency'), 100
        );
        $this->listeners[] = $sharedEvents->attach(
            '*', 'log.alert', array($this, 'onAlert'), 100
        );
        $this->listeners[] = $sharedEvents->attach(
            '*', 'log.critical', array($this, 'onCritical'), 100
        );
        $this->listeners[] = $sharedEvents->attach(
            '*', 'log.error', array($this, 'onError'), 100
        );
        $this->listeners[] = $sharedEvents->attach(
            '*', 'log.warning', array($this, 'onWarning'), 100
        );
        $this->listeners[] = $sharedEvents->attach(
            '*', 'log.notice', array($this, 'onNotice'), 100
        );
        $this->listeners[] = $sharedEvents->attach(
            '*', 'log.info', array($this, 'onInfo'), 100
        );
        $this->listeners[] = $sharedEvents->attach(
            '*', 'log.debug', array($this, 'onDebug'), 100
        );
        $this->listeners[] = $sharedEvents->attach(
            '*', 'log.message', array($this, 'onMessage'), 100
        );
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onEmergency(EventInterface $e)
    {
        $this->logMessage($e, LogLevel::EMERGENCY);
    }

    public function onAlert(EventInterface $e)
    {
        $this->logMessage($e, LogLevel::ALERT);
    }

    public function onCritical(EventInterface $e)
    {
        $this->logMessage($e, LogLevel::CRITICAL);
    }

    public function onError(EventInterface $e)
    {
        $this->logMessage($e, LogLevel::ERROR);
    }

    public function onWarning(EventInterface $e)
    {
        $this->logMessage($e, LogLevel::WARNING);
    }

    public function onNotice(EventInterface $e)
    {
        $this->logMessage($e, LogLevel::NOTICE);
    }

    public function onInfo(EventInterface $e)
    {
        $this->logMessage($e, LogLevel::INFO);
    }

    public function onDebug(EventInterface $e)
    {
        $this->logMessage($e, LogLevel::DEBUG);
    }

    public function onMessage(EventInterface $e)
    {
        $level = $e->getParam('level');
        $this->logMessage($e, $level);
    }

    private function logMessage(EventInterface $e, $level = null)
    {
        $message = $e->getParam('message');
        $class = get_class($e->getTarget());
        if (null === $level) {
            $level = LogLevel::INFO;
        }
        $this->logger->log($level, $message, ['class' => $class]);
    }
}