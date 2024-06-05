<?php

class HtmlTag 
{
    public string $name;

    public string | null $id = null;

    public string | null $className = null;

    public array $styles = [];

    public string $innerHtml = '';

    public array $customAttributes = [];

    public function __construct(string|null $id = null, string|null $className=null, string $innerHtml = '', array $styles=[], string $name = 'div', array $customAttributes=[]){
        $this->name = $name;
        $this->id = $id;
        $this->className = $className;
        $this->styles = $styles;
        $this->innerHtml = $innerHtml;
        $this->customAttributes = $customAttributes;
    }

    public function render() 
    {
        $context = "<{$this->name}";
        if ($this->id !== null) {
            $context .= " ";
            $context .= "id = \"{$this->id}\"";
        }
        if ($this->className !== null) {
            $context .= " ";
            $context .= "class = \"{$this->className}\"";
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