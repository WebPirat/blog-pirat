<?php
namespace content;
require_once ('autoloader.php');

class footer
{
    private $uri;
    private $database;
    private $settings;

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function get(){
        echo '</html>';
    }
}