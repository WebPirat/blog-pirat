<?php
namespace content\layout;

class header
{
    public array $siteinfo;


    public function __construct()
    {
        $this->siteinfo['title'] = 'Yolo';
    }
    public function get(): void
    {
        echo '<!DOCTYPE html>
                <html lang="de">
                <head>                
                  <title>'.$this->siteinfo['title'].'</title>
                    <link rel="apple-touch-icon" sizes="180x180" href="/assets/icon/apple-touch-icon.png">
                    <link rel="icon" type="image/png" sizes="32x32" href="/assets/icon/favicon-32x32.png">
                    <link rel="icon" type="image/png" sizes="16x16" href="/assets/icon/favicon-16x16.png">
                    <link rel="manifest" href="/assets/icon/site.webmanifest">
                    <link rel="mask-icon" href="/assets/icon/safari-pinned-tab.svg" color="#5bbad5">
                    <link rel="shortcut icon" href="/assets/icon/favicon.ico">
                    <link rel="stylesheet" href="/assets/css/blogpirat.css">
                    <meta name="msapplication-TileColor" content="#da532c">
                    <meta name="msapplication-config" content="/assets/icon/browserconfig.xml">
                    <meta name="theme-color" content="#ffffff">
                </head>
                <body>
                <div class="app">
                ';
    }
}