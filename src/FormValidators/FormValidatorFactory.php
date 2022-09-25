<?php

namespace FormValidators;

use Forms\FormElement;
use Objects\FormValidations;

/**
 * Create instance of Form field validator
 */

class FormValidatorFactory
{
    /**
     * Create instance of Validator
     * 
     * @param FormValidations $validator
     * @param FormElement $field
     * 
     * @return FormValidatorInterface
     */
    public static function getValidator(FormValidations $validator, FormElement $field): FormValidatorInterface
    {
        switch ($validator->validation_key) 
        {
            case 'number':
                return new NumberFormValidator($field, $validator);
            case 'required':
                return new RequiredFormValidator($field);
            case 'string':
                return new StringFormValidator($field);
            case 'unique':
                return new UniqueFormValidator($field);
            case 'file_size':
                return new FileSizeFormValidator($field, $validator);
            case 'file_type':
                return new FileTypeFormValidator($field, $validator);
            default: 
                throw new \Exception ("Unknown validator key: ". $validator->validation_key);
        }
    }

}