<?php
namespace models;

class blog
{
    private $database;
    private $settings;

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
    }

    public function getLast10Blogs(){
        return $this->database->query('SELECT title, teaser, content, site_alias, author, ID, created_At FROM blog_entrys WHERE deleted = 0 AND online = 1 ORDER BY created_At DESC LIMIT 7')->fetchAll();
    }
    public function getMainBlogCat($id){
        if(!empty($id)) {
            $catID = $this->database->query('SELECT catID FROM blog_to_cat WHERE blogID = ? ORDER BY sort_order DESC LIMIT 1', $id)->fetchString('catID');
            if(!empty($catID)) {
                return $this->database->query('SELECT * FROM blog_cat WHERE ID = ?', $catID)->fetchString('name');
            }
        }
    }
}