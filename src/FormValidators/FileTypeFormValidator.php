<?php

namespace FormValidators;

use Forms\FormElement;
use Objects\FormValidations;

/**
 * Validate file type
 */

class FileTypeFormValidator extends FormValidatorBase implements FormValidatorInterface
{  
    private FormValidations $validator;

    public function __construct(FormElement $field, FormValidations $validator)
    {
        $this->validator = $validator;
        parent::__construct($field);
    }

    public function validate(): bool
    {
        if (empty($this->field->getValue()['tmp_name'])) {
            return true;
        }

        $fileValidators = json_decode($this->validator->additional_settings, true);
        $ext = pathinfo($this->field->getValue()['name'], PATHINFO_EXTENSION);
        $mimeType = mime_content_type($this->field->getValue()['tmp_name']);

        if (isset($fileValidators['extensions']) && !in_array($ext, $fileValidators['extensions'])) {
            $this->setFieldError("Not allowed extension. Allowed extensions: ". implode(',', $fileValidators['extensions']));
            return false;
        }

        if (isset($fileValidators['formats']) && !in_array($mimeType, $fileValidators['formats'])) {
            $this->setFieldError("Not allowed format. Allowed formats: ". implode(',', $fileValidators['formats']));
            return false;
        }

        return true;
    }

}