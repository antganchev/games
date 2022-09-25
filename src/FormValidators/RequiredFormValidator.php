<?php

namespace FormValidators;

/**
 * Validate if form field has value
 */

class RequiredFormValidator extends FormValidatorBase implements FormValidatorInterface
{

    public function validate(): bool
    {
        if (empty($this->field->getValue()) && $this->field->getValue() !== '0') {
            $this->setFieldError($this->field->fieldName . " is required!");
            return false;
        }
        return true;
    }

}