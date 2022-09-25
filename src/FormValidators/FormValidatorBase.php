<?php

namespace FormValidators;

use Forms\FormElement;

/**
 * Base FormValidator class with common methods
 */

class FormValidatorBase 
{
    protected FormElement $field;

    public function __construct(FormElement $field)
    {
        $this->field = $field;
    }

    public function setFieldError($message)
    {
        $this->field->hasError = true;
        $this->field->errorMessages[] = $message;
    }

}