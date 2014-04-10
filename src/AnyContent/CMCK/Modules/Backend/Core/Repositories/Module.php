<?php

namespace AnyContent\CMCK\Modules\Backend\Core\Repositories;

use AnyContent\CMCK\Modules\Backend\Core\Application\Application;
use AnyContent\CMCK\Modules\Backend\Core\Repositories\RepositoryManager;

class Module extends \AnyContent\CMCK\Modules\Backend\Core\Core\Module
{

    public function init(Application $app, $options = array())
    {
        parent::init($app, $options);

        $app['repos'] = $app->share(function ($app)
        {
            return new RepositoryManager($app['cache'],$app['context']);
        });

    }

}