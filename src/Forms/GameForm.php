<?php

namespace Forms;

use Objects\Games;

/**
 * Game form
 */

class GameForm extends BaseForm
{
    /**
     * Initialize Game form and add the fields to the form
     */
    public function init(): void
    {
        $state = new FormElement("state", [
            'type'  => "radio_group",
            'name' => 'state',
            'value' => 0,
            'options' => Games::STATES
        ], $this);
        $this->addField("state", $state);

        $nameField = new FormElement("name", [
            'class' => "form-control",
            'id'    => "name",
            'placeholder' => "Name",
            'type' => "text"
        ], $this);
        $nameField->setLabel("Name");
        $this->addField("name", $nameField);

        $pictureField = new FormElement("picture", [
            'id'    => "picture",
            'type' => "file"
        ], $this);
        $this->addField("picture", $pictureField);
    }

    /**
     * Get FormName, used for binding validations to fields.
     */
    public function getFormName(): string
    {
        return "GameForm";
    }

}