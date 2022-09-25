<?php

namespace Forms;

/**
 * Form elements - inputs
 */

class FormElement
{
    protected array $validations = [];
    protected $value = null;
    protected $label = null;
    public array $attributes = [];
    public string $fieldName;
    public BaseForm $form;
    public bool $hasError = false;
    public array $errorMessages = [];
    

    public function __construct(string $fieldName, array $attributes, BaseForm $form)
    {
        $this->fieldName = $fieldName;
        $this->attributes = $attributes;
        $this->form = $form;
    }

    /**
     * Set field input label
     * 
     * @return void
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * Get field input label
     * 
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Set field value
     * 
     * @param any $value
     * 
     * @return void
     */
    public function setValue($value): FormElement
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get field value
     * 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Generate html attribute with its value
     * 
     * @param string $attribute
     * 
     * @return string 
     */
    public function getHTMLAttribute(string $attribute): string
    {
        if (!isset($this->attributes[$attribute]))
            return '';

        return $attribute . "=" . $this->attributes[$attribute];
    }

    /**
     * Render a input field
     * 
     * @return string
     */
    public function render(): string 
    {
        return "<input name='{$this->fieldName}'"
        . $this->getHTMLAttribute("id") . " "
        . $this->getHTMLAttribute("type") . " "
        . "class='". $this->attributes["class"]. ($this->hasError ? ' is-invalid' : '') ."'" . " " 
        . "value='" . htmlspecialchars($this->getValue()) . "' " 
        . $this->getHTMLAttribute("placeholder") ." />";
    }

    /**
     * Render a input field with label and div holder
     * 
     * @return string
     */
    public function renderDecorated(): string
    {
        $fieldHtml = "<div class='form-floating'>";

        $fieldHtml .= $this->render();

        
        if (!empty($this->getLabel())) {
            $fieldHtml .= "<label for='{$this->getHTMLAttribute("id")}'>{$this->getLabel()}</label>";
        }

        if(count($this->errorMessages)):
            $fieldHtml .= '<p class="text-danger form-error text-left">'.implode('. ', $this->errorMessages).'</p>';
        endif;

        $fieldHtml .= "</div>";
        
        return $fieldHtml;
    }

    /**
     * Render radio group fields
     * 
     * @return string
     */
    public function renderRadioGroup(): string
    {
        if ($this->attributes['type'] !== 'radio_group')
            throw new \Exception("You are trying to create radio group for field which is not set as radio group");

        $groupHtml = "<div class='form-group'>";
        foreach ($this->attributes['options'] as $value => $label) {
            $groupHtml .= "<label>";
            $groupHtml .= "<input type='radio' name='{$this->fieldName}' value='{$value}' " . (!is_null($this->getValue()) && $this->getValue() == $value ? 'checked' : '') . " />"; 
            $groupHtml .= " {$label}</label>";
        }
        if(count($this->errorMessages)):
            $groupHtml .= '<p class="text-danger form-error text-left">'.implode('. ', $this->errorMessages).'</p>';
        endif;

        $groupHtml .= "</div>";

        return $groupHtml;
    }
    
    /**
     * Render a file input
     * 
     * @return string
     */
    public function renderFileInput(): string 
    {
        $fieldHtml = "<input name='{$this->fieldName}'"
        . $this->getHTMLAttribute("id") . " "
        . $this->getHTMLAttribute("type") . " "
        . "class='". $this->attributes["class"]. ($this->hasError ? ' is-invalid' : '') ."'" . " " 
        ." />";
        
        if(count($this->errorMessages)):
            $fieldHtml .= '<p class="text-danger form-error text-left">'.implode('. ', $this->errorMessages).'</p>';
        endif;

        return $fieldHtml;
    }


}