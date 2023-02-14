<?php
namespace content\layout;

use modals\text;

class footer
{
    public object $text;
    public function __construct()
    {
        $this->text = new text();
    }

    public function get() {
        echo 'Footer';
    }
}