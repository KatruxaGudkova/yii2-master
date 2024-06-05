<?php

class HtmlTag 
{
    public string $name;

    public string | null $id = null;

    public string | null $className = null;

    public array $styles = [];

    public string $innerHtml = '';

    public array $customAttributes = [];


    public function render() 
    {
        $context = "<{$this->name}";
        if ($this->id !== null) {
            $context .= " ";
            $context .= "id = \"{$this->id}\"";
        }
        if ($this->className !== null) {
            $context .= " ";
            $context .= "calss = \"{$this->className}\"";
        }
        if (empty($this->styles) === false) {
            $style = [];
            foreach($this->styles as $key => $value) {
                $style[] = "$key : $value"; 
            } 
            $context .= " ";
            $context .= 'style = "' . implode('; ', $style) . '"';
        }
        $context .= implode(' ', $this->customAttributes) . ">{$this->innerHtml} </{$this->name}>";
        return $context;
    }

}