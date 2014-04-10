<?php

namespace AnyContent\CMCK\Modules\Backend\Edit\SequenceFormElement;

use AnyContent\CMCK\Modules\Backend\Core\Application\Application;

class Module extends \AnyContent\CMCK\Modules\Backend\Core\Core\Module
{

    public function init(Application $app, $options = array())
    {
        $app->addTemplatesFolders(__DIR__ . '/views/');

        // additional query parameter insertedby
        $app
            ->get('/sequence/edit/{contentTypeAccessHash}/{viewName}/{insertName}/{recordId}/{property}', 'AnyContent\CMCK\Modules\Backend\Edit\SequenceFormElement\Controller::editSequence')
            ->bind('editSequence');
        $app
            ->post('/sequence/edit/{contentTypeAccessHash}/{viewName}/{insertName}/{recordId}/{property}', 'AnyContent\CMCK\Modules\Backend\Edit\SequenceFormElement\Controller::postSequence')
            ->bind('postSequence');

        // additional query parameter insert and count
        $app
            ->get('/sequence/add/{contentTypeAccessHash}/{viewName}/{insertName}/{property}', 'AnyContent\CMCK\Modules\Backend\Edit\SequenceFormElement\Controller::addSequenceItem')
            ->bind('addSequenceItem');
    }


    public function run(Application $app)
    {
        $app['form']->registerFormElement('sequence', 'AnyContent\CMCK\Modules\Backend\Edit\SequenceFormElement\FormElementSequence');

    }

}