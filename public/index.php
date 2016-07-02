<?php
error_reporting(E_ALL);

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

try {
    define('APP_PATH', realpath('..') . '/');
    // Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();
    // Create a DI
    $di = new FactoryDefault();

    // Setup the database service
    $di->set('db', function () {
        return new DbAdapter(array(
            "host"     => "localhost",
            "username" => "root",
            "password" => "123456", 
            "dbname"   => "cungbaynao"
        ));
    });

    // Setup the view component
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    // Setup a base URI so that all generated URIs include the "tutorial" folder
    $di->set('url', function () {
        $url = new UrlProvider();
        $url->setBaseUri('/');
        return $url;
    });

    // Handle the request
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
     echo "Exception: ", $e->getMessage();
}