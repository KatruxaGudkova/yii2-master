<?php
require_once PROJECT_ROOT . "src/components/HtmlTag.php";

class Alert extends HtmlTag
{
    public function __construct(string $text = '', string $type = 'primary', array $styles = [], string|null $id = null){
        parent::__construct($id, 'alert alert-'.$type, $text, $styles, 'div', ['role ="alert"']);}
        
}