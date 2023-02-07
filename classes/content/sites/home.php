<?php
namespace content\sites;

use content\components\blog\blogTeaser;
use helper\textParser;
use models\blog;

class home
{
    public object $content;
    public int $siteID;
    public object $blog;

    public function __construct()
    {
        $this->blog = new blog();
    }

    public function getBlog(): string
    {
        $textparser = new textParser();
        $blogteaser = new blogTeaser();
        $bloglist = $this->blog->getLast10Blogs();
        $singleblog = array_shift($bloglist);
        if(strlen($singleblog['title'])) {
            $singleblog['title'] = substr($singleblog['title'], 0, 27).'<span style="font-family: ChalkNumbers; font-size: 14px"> . . .</span>';
        }
        $singletext = $textparser->explodeStringIntoMultiple($singleblog['teaser']);

        $response = '';
        $response .= '<div class="grid-3">';
        $response .= '<div class="papagei-cage">
                         <img src="/assets/img/papagei.png" class="papagei">
                         ';
        $response .=    '</div>
                            <div class="blog-papagei-rotate">'.$blogteaser->getTeaser($singleblog, 1).'</div>
                        </div>
                      ';
        $response .= '<div class="grid-3">';
        foreach($bloglist as $key => $entry){
            $boxnumber = rand(1,4);
            $response .= $blogteaser->getTeaser($entry);
        }
        $response .= '</div>';
        return $response;
    }

    public function routes(){
        return [];
    }

    public function get(){
        echo '<div class="grid-home-container">
                <div><img class="img-responsive" src="/assets/img/pirat_run_angry.png"></div>
                <div>'.$this->getBlog().'
                <div><img src="/assets/img/pirate_wiese.png"></div>
                </div>
              </div>
              
              ';
    }
}