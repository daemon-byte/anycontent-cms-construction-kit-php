<?php
namespace AnyContent\CMCK\Modules\Backend\Edit\ReferenceFormElements;

use AnyContent\Client\Repository;

class FormElementMultiReference extends \AnyContent\CMCK\Modules\Backend\Edit\SelectionFormElements\FormElementMultiSelection
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

            $records = $repository->getRecords($workspace, $viewName, $language, $order, $timeshift);

            foreach ($records as $record)
            {
                $options[$record->getId()] = '#' . $record->getId() . ' ' . $record->getName();
            }
        }
        else{
            $app['context']->addAlertMessage('Could not find referenced content type '.$this->definition->getContentType().'.');
        }

        $this->vars['options'] = $options;
    }


    public function render($layout)
    {

        return $this->twig->render('formelement-multiselection.twig', $this->vars);
    }

}