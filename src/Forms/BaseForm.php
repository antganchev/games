<?php

namespace Forms;

use Objects\BaseObject;

/**
 * Base form class
 */

abstract class BaseForm
{

    protected array $fields = [];
    public ?BaseObject $entity = null;
    public string $errorMessage;
    public string $successMessage;

    public function __construct()
    {
        $this->init();
    }

    abstract function init(): void;

    abstract function getFormName(): string;

    /**
     * Add field to a form
     * 
     * @param string $fieldName
     * @param FormElement $formElement
     * 
     * @return void
     */
    public function addField(string $fieldName, FormElement $formElement): void
    {
        $this->fields[$fieldName] = $formElement;
    }

    /**
     * Validate form based on binded validation to form's fields
     * 
     * @return bool
     */
    public function validate(): bool
    {
        $valid = true;
        foreach ($this->fields as $field) {
            $fieldValidation = new FormElementValidation($field);
            if (!$fieldValidation->validate()) {
                $valid = false;
            }
        }

        return $valid;
    }

    /**
     * Bind request data to the fields
     * 
     * @param array $data
     * @param BaseObect $entity
     * 
     * @return void
     */
    public function bind(array $data, BaseObject $entity): void
    {
        foreach ($data as $fieldKey => $fieldValue) {
            $field = $this->get($fieldKey);
            $field->setValue($fieldValue);

            if ($field->attributes['type'] !== 'file') {
                $entity->{$fieldKey} = $fieldValue;
            }
        }

        $this->entity = $entity;
    }

    /**
     * Get form field
     * 
     * @param string $fieldName
     * 
     * @return FormElement
     */
    public function get(string $fieldName): FormElement
    {
        if (!isset($this->fields[$fieldName])) 
            throw new \Exception("Unknown form field");

        return $this->fields[$fieldName];
    }

}