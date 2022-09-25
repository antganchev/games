<?php

namespace FormValidators;

use Forms\FormElement;

/**
 * Interface for Form validators
 */

interface FormValidatorInterface 
{
    public function validate(): bool;
}