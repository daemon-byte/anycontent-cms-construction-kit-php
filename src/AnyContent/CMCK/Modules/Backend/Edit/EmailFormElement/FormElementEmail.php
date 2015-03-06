<?php

namespace AnyContent\CMCK\Modules\Backend\Edit\EmailFormElement;

class FormElementEmail extends \AnyContent\CMCK\Modules\Backend\Core\Edit\FormElementDefault
{

    public function render($layout)
    {
        $layout->addJsFile('fe-em.js');
        return $this->twig->render('formelement-email.twig', $this->vars);
    }
}