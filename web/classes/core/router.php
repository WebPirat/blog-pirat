<?php
namespace core;

use content\layout\body;
use content\layout\footer;
use content\layout\header;
use helper\assetsParser;

class router
{
    public object $header;
    public object $body;
    public object $footer;
    private object $settings;
    private string $uri;

    public function __construct()
    {
        $this->settings = new settings();
        $this->uri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $this->header = new header();
        $this->body = new body();
        $this->footer = new footer();
    }

    public function route(){
        $test = new assetsParser();
        $test->scanAllAssets();
        /*
        $this->header->get();
        $this->body->get();
        $this->footer->get();
        */
    }
}