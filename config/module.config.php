<?php
return array(
    'controller_plugins' => array(
        'invokables' => array(
            'log'       => 'ZendLogger\Controller\Plugin\Log',
            'debug'     => 'ZendLogger\Controller\Plugin\Debug',
            'info'      => 'ZendLogger\Controller\Plugin\Info',
            'notice'    => 'ZendLogger\Controller\Plugin\Notice',
            'warning'   => 'ZendLogger\Controller\Plugin\Warning',
            'error'     => 'ZendLogger\Controller\Plugin\Error',
            'critical'  => 'ZendLogger\Controller\Plugin\Critical',
            'alert'     => 'ZendLogger\Controller\Plugin\Alert',
            'emergency' => 'ZendLogger\Controller\Plugin\Emergency',
        ),
    ),
);