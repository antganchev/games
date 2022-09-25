<?php

namespace FormValidators;

use Forms\FormElement;
use Objects\FormValidations;

/**
 * Validate if form field is number
 */

class NumberFormValidator extends FormValidatorBase implements FormValidatorInterface
{  
    const NUMBER_REGEXT = "/^[0-9]*$/";
    
    private FormValidations $validator;

    public function __construct(FormElement $field, FormValidations $validator)
    {
        $this->validator = $validator;
        parent::__construct($field);
    }

    public function validate(): bool
    {
        if (empty($this->field->getValue())) {
            return true;
        }

        if(!preg_match(self::NUMBER_REGEXT, $this->field->getValue())) {
            $this->setFieldError($this->field->fieldName . " is not a number!");
            return false;
        }

        $additionalValidators = json_decode($this->validator->additional_settings, true);
        if (isset($additionalValidators['inclusion']) && !in_array($this->field->getValue(), $additionalValidators['inclusion'])) {
            $this->setFieldError($this->field->fieldName . " should be equal to one of these values: ".implode(',', $additionalValidators['inclusion'])."!");
            return false;
        }

        return true;
    }

}