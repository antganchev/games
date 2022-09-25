<?php

namespace FormValidators;

/**
 * Validate if form field is string
 */

class StringFormValidator extends FormValidatorBase implements FormValidatorInterface
{  
    const STRING_REGEXT = "/^[a-z0-9 .\-]+$/i";

    public function validate(): bool
    {
        if (empty($this->field->getValue())) {
            return true;
        }

        if(!preg_match(self::STRING_REGEXT, $this->field->getValue())) {
            $this->setFieldError($this->field->fieldName . " contains not allowed symbols!");
            return false;
        }

        return true;
    }

}