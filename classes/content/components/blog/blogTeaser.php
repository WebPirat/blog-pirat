<?php

namespace content\components\blog;

use models\blog;

class blogTeaser
{
     private int $oldboxnr;
     private int $boxnr;
     private object $blog;


     public function __construct()
     {
         $this->boxnr = 1;
         $this->oldboxnr = 0;
         $this->blog = new blog();
     }

    /**
     * @return int
     */
    public function getBox()
    {
        $start = 1;
        $end = 4;

        do {
            $box = rand($start,$end);
        } while ($this->oldboxnr == $box);

        if ($this->oldboxnr != $box) {
            $this->oldboxnr = $box;
            return $box;
        }
    }

     public function getTeaser($blog, $boxnr = null): string{
        if(empty($boxnr)) {
            $boxnr = $this->getBox();
        }
        $cat = $this->blog->getMainBlogCat($blog['ID']);
        if(empty($cat)){
            $cat = 'Yolo';
        }
         $response = '<div class="home-blog-container" style="background-image: url(/assets/img/pirate_box'.$boxnr.'.png); background-repeat: no-repeat;position: relative">
                            <div class="blog-wrapper"> 
                            <div class="blog-inner-wrapper">
                              <h3>'.$blog['title']. '</h3>
                              <p class="blog-p"> '.$blog['teaser']. '</p >
                            </div>       
                              <div class="blog-footer grid-3">
                                <div class="grid-start">'.$blog['author']. '</div>
                                <div class="grid-center"></div>
                                <div class="grid-end">Mehr lesen</div>
                              </div>
                              <div class="blog-date">'. date("d m y", strtotime($blog['created_At'])). '</div>
                              <div class="blog-cat">'.$cat.'</div>
                            </div>
                             </div>                   
                          ';

         return $response;
     }
    }