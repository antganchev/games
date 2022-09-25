<?php

namespace Objects;

/**
 * Represents structure of the form_validation object 
 */

class FormValidations extends BaseObject
{
    public $id;
    public $form;
    public $field;
    public $validation_key;
    public $additional_settings;

    public static function getTable(): string
    {
        return "form_validations";
    }

    public static function getPKColumn(): string
    {
        return "id";
    }

}