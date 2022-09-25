<?php

namespace FormValidators;

/**
 * Validate if field has unique value and it is not presented in DB
 */

class UniqueFormValidator extends FormValidatorBase implements FormValidatorInterface
{  

    public function validate(): bool
    {
        if (empty($this->field->getValue())) {
            return true;
        }

        $existingItem = $this->field->form->entity::findFirst("{$this->field->fieldName} = :fieldValue", ['fieldValue' => $this->field->getValue()]);
        if (!is_null($existingItem->{$existingItem::getPKColumn()})) {
            $this->setFieldError("There is already existing row with column {$this->field->fieldName} with value: " . $this->field->getValue());
            return false;
        }

        return true;
    }

}