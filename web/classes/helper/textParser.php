<?php
namespace helper;
use models\text;


class textParser
{
    public object $text;
    private array $strings;

    public function __construct()
    {
        $this->text = new text();
        $this->strings = [
            '{YEAR}' => date("Y")
        ];
        $this->pushVarstoStrings();
    }

    /**
     * Adds the Vars from the DB to the parser DB overwrites same name(key) as in array so watch out
     * @return void
     */
    private function pushVarsToStrings():void{
        $allVars = $this->text->getAllTextVars();
        foreach ($allVars as $vars){
            $this->strings[$vars['name']] = $vars['content'];
        }
    }

    /**
     * @param $name
     * @return string
     */
    public function getText($name): string
    {
        $string = $this->text->getTextByName($name);
        return $this->parseText($string);
    }

    /**
     * @param $string
     * @return string
     */

    private function parseText($string): string
    {
        return strtr($string, $this->strings);
    }
}