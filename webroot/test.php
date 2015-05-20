<?php

require __DIR__.'/config_with_app.php';

$di->setShared('flash', function() {
    $flash = new \flashmessage\CFlashMessage\CFlashMessage();
    return $flash;
});

// Other services, modules, controllers here

// Starts the session (required by the Flashy class)
$app->session;

// Extra stylesheet
$app->theme->addStylesheet('css/flash.css');

// Routes
$app->router->add('', function() use ($app) {

    $app->theme->setTitle("Flash test");

    $app->session;

    $app->flash->add('notice', 'This is a notice message');
    $app->flash->add('error', 'This is a error message');
    $app->flash->add('success', 'This is a success message');
    $app->flash->add('warning', 'This is a warning message');


    $app->theme->setVariable('title', "Flash test")
           ->setVariable('main', $app->flash->get());

});

$app->router->handle();
$app->theme->render();
