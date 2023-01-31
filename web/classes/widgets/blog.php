<?php
namespace widgets;

class blog
{
    private $database;
    private $settings;

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
    }
}