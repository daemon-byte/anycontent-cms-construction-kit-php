<?php

namespace AnyContent\CMCK\Modules\Backend\Edit\EmailFormElement;

use AnyContent\CMCK\Modules\Backend\Core\Application\Application;

class Module extends \AnyContent\CMCK\Modules\Backend\Core\Core\Module
{

    public function init(Application $app, $options = array())
    {
        parent::init($app, $options);

        $app->addTemplatesFolders(__DIR__ . '/views/');

    }


    public function run(Application $app)
    {
        $app['form']->registerFormElement('email', 'AnyContent\CMCK\Modules\Backend\Edit\EmailFormElement\FormElementEmail');

    }

}