<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    APP_PATH . $config->application->controllersDir,
    APP_PATH . $config->application->modelsDir
])->register();

$loader->registerClasses([
    'Services' => APP_PATH . 'app/Services.php'
]);

