#ZendLogger

Integration of any PSR-3 logger to ZendFramework2 project.
This package allow you easily log errors through EventManager.


INSTALL
=======

The recommended way to install is through composer.

```json
{
    "require": {
        "nemutaisama/zend-logger": "*@dev"
    }
}
```

or just

`composer require nemutaisama/zend-logger:*@dev`

USAGE
=====

1. Add `ZendLogger` to your `config/application.config.php` to enable module.

2. Configure any PSR-3 log service, and register it in ServiceManager.

3. Copy the config file `config/zendlogger.global.php.dist` from the module to config/autoload your project.

At this moment config is pretty simple - just set name of your log service.
Default config use [EnliteMonolog package](https://github.com/enlitepro/enlite-monolog) with service name from default config.

```php
    'ZendLogger' => 'YourLoggerServiceName'
```

Now you can use it.

This package come with set of ControllerPlugins and trait for model.
From controller you can just use it.

```php
class IndexController extends AbstractActionController {
    public function indexAction(){
        ...
        $this->debug('message', [context]);
        $this->info('message', [context]);
        $this->notice('message', [context]);
        $this->warning('message', [context]);
        $this->error('message', [context]);
        $this->critical('message', [context]);
        $this->alert('message', [context]);
        $this->emergency('message', [context]);
        $this->log($level, 'message', [context]);
        ...
    }
}
```

From model classes you can just use trait.
Since package use EventManager you should have it available in class.
For example by simply use Zend\EventManager\EventManagerAwareTrait.
After that usage is same as in controller.

```php
namespace MyPackage;
use ZendLogger\LoggerTrait;
use Zend\EventManager\EventManagerAwareTrait;
class MyModel {
    use LoggerTrait;
    use EventManagerAwareTrait;
    public function logErrors(){
        ...
        $this->debug('message', [context]);
        $this->info('message', [context]);
        $this->notice('message', [context]);
        $this->warning('message', [context]);
        $this->error('message', [context]);
        $this->critical('message', [context]);
        $this->alert('message', [context]);
        $this->emergency('message', [context]);
        $this->log($level, 'message', [context]);
        ...
    }
}
```
    
Events
======

You can also handle errors for anything else hooking events from shared event manager

```php
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents = $events->getSharedManager();
        $this->listeners[] = $sharedEvents->attach('*', 'log.emergency', array($this, 'onEmergency'), 100);
        $this->listeners[] = $sharedEvents->attach('*', 'log.alert', array($this, 'onAlert'), 100);
        $this->listeners[] = $sharedEvents->attach('*', 'log.critical', array($this, 'onCritical'), 100);
        $this->listeners[] = $sharedEvents->attach('*', 'log.error', array($this, 'onError'), 100);
        $this->listeners[] = $sharedEvents->attach('*', 'log.warning', array($this, 'onWarning'), 100);
        $this->listeners[] = $sharedEvents->attach('*', 'log.notice', array($this, 'onNotice'), 100);
        $this->listeners[] = $sharedEvents->attach('*', 'log.info', array($this, 'onInfo'), 100);
        $this->listeners[] = $sharedEvents->attach('*', 'log.debug', array($this, 'onDebug'), 100);
        $this->listeners[] = $sharedEvents->attach('*', 'log.message', array($this, 'onMessage'), 100);
    }
```