<?php

namespace FormValidators;

use Forms\FormElement;
use Objects\FormValidations;

/**
 * Validate file upload size
 */

class FileSizeFormValidator extends FormValidatorBase implements FormValidatorInterface
{  
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

        $max_file_size = $this->validator->additional_settings;
        $fileSize = filesize($this->field->getValue()['tmp_name']);

        if ($fileSize > $max_file_size) {
            $this->setFieldError("Picture should be <= {$max_file_size} bytes");
            return false;
        }

        return true;
    }

}