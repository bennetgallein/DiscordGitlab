<?php
namespace DiscordGitlab\Types;

use \DiscordWebhooks\Embed;

class Issue {

    private $embedcontent;
    private $color = '15158332';
    private $author;
    private $title;
    private $url;

    public function __construct($data) {
        $this->author = $data['user']['name'];
        $this->title = $data['object_attributes']['title'];
        $this->embedcontent = $data['object_attributes']['description'];
    }
    public function getEmbedObject() {
        $embed = new Embed();
        return $embed->color($this->color)->title($this->title)->author($this->author)->description($this->embedcontent);
    }
}
