<?php
namespace content\sites;

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
        $bloglist = $this->blog->getLast10Blogs();
        $singleblog = array_shift($bloglist);
        $response = '';
        $response .= '<div class="grid-3">';
        $response .= '<div class="papagei-cage">
                         <img src="/assets/img/papagei.png" class="papagei">
                         ';
        $response .=    '</div>
                        </div>
                      ';
        $response .= '<div class="grid-3">';
        $response .= '<div class="home-blog-container" style="grid-column-start: 2; transform: rotate(10deg); margin-bottom: 20px">
                        <div class="blog-wrapper"> ';
        $response .= '    <h3>'.$singleblog['title']. '</h3>
                          <p>'.$singleblog['teaser']. '</p>
                          <div class="blog-footer grid-3">
                            <div class="grid-start">'.$singleblog['author']. '</div>
                            <div class="grid-center">'. date("d-m-Y", strtotime($singleblog['created_At'])). '</div>
                            <div class="grid-end">Mehr lesen</div>
                          </div>
                            ';
        $response .=    '</div>
                         </div>
                        <div></div>
                      ';
        foreach($bloglist as $key => $entry){
            $response .= '<div class="home-blog-container" >
                    '.$key.'
                  </div>';
        }
        $response .= '</div>';
        return $response;
    }


    public function get(){
        echo '<div class="grid-home-container">
                <div><img class="img-responsive" src="/assets/img/pirat_run_angry.png"></div>
                <div>'.$this->getBlog().'
                <div style="border: 1px solid black">yolo</div>
                </div>
              </div>
              
              ';
    }
}