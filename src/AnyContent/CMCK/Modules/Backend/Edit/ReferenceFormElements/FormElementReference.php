<?php
namespace AnyContent\CMCK\Modules\Backend\Edit\ReferenceFormElements;

use AnyContent\Client\Repository;

class FormElementReference extends \AnyContent\CMCK\Modules\Backend\Edit\SelectionFormElements\FormElementSelection
{

    public function __construct($id, $name, $formElementDefinition, $app, $value = '')
    {
        parent::__construct($id, $name, $formElementDefinition, $app, $value);

        $this->vars['type'] = $this->definition->getType();

        /** @var Repository $repository */
        $repository = $app['context']->getCurrentRepository();

        $options = array();

        if ($repository->selectContentType($this->definition->getContentType()))
        {
            $contentTypeDefinition = $repository->getContentTypeDefinition();

            $workspace = $this->definition->getWorkspace();
            $viewName  = $contentTypeDefinition->getListViewDefinition()->getName();
            $language  = $this->definition->getLanguage();
            $order     = $this->definition->getOrder();
            $timeshift = $this->definition->getTimeShift();


            $repository->stashDimensions()->setWorkspace($workspace)->setViewName($viewName)->setLanguage($language)->setOrder($order)->setTimeshift($timeshift);

            $records = $repository->getRecordsAsIDNameList();

            $repository->unStashDimensions();

            foreach ($records as $id => $name)
            {
                $options[$id] = '#' . $id. ': ' . $name;
            }
        }
        else{
            $app['context']->addAlertMessage('Could not find referenced content type '.$this->definition->getContentType().'.');
        }

        $this->vars['options'] = $options;
    }


    public function render($layout)
    {

        return $this->twig->render('formelement-selection.twig', $this->vars);
    }

}