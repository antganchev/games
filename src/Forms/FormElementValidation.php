<?php

namespace Forms;

use FormValidators\FormValidatorFactory;
use Objects\FormValidations;

/**
 * Bind validations to form fields
 */

class FormElementValidation
{
    private FormElement $field;

    public function __construct(FormElement $field)
    {
        $this->field = $field;
    }

    /**
     * Validate field value
     * 
     * @return bool
     */
    public function validate(): bool
    {
        $valid = true;
        $validations = $this->getFieldValidations();
        foreach ($validations as $validation) {
            $validator = FormValidatorFactory::getValidator($validation, $this->field);
            if (!$validator->validate()) {
                $valid = false;
            }
        }
        return $valid;
    }

    /**
     * Get field validations from DB
     * 
     * @return array
     */
    private function getFieldValidations(): array
    {
        $validations = FormValidations::findAll('form = :form AND field = :field', ['form' => $this->field->form->getFormName(), 'field' => $this->field->fieldName]);
        return $validations;
    }

}