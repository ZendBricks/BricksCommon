<?php

namespace BricksCommon\Form;

use Zend\Form\Form;
use Zend\Form\Element\Submit;

class DeleteForm extends Form
{
    public function __construct()
    {
        parent::__construct('delete');
        $this->setAttribute('method', 'post');

        $submit = new Submit('delete');
        $submit->setValue('Delete');
        $this->add($submit);
    }
}
