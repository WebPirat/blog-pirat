<?php
namespace core;

use content\layout\body;
use content\layout\footer;
use content\layout\header;

class router
{
    public object $header;
    public object $body;
    public object $footer;
    private object $settings;

    public function __construct()
    {
        $this->settings = new settings();
        $this->header = new header();
        $this->body = new body();
        $this->footer = new footer();
    }

    public function route(){
        $this->header->get();
        $this->body->get();
        $this->footer->get();
    }
}