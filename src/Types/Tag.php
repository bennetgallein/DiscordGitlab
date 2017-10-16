<?php
namespace DiscordGitlab\Types;

use \DiscordWebhooks\Embed;

class Tag {

    private $embedcontent;
    private $color = '9323693';
    private $author;
    private $title;
    private $url;
    private $img_url;

    public function __construct($data) {
        $this->embedcontent = "";
        $this->author = $data['user_name'];
        $version = array_reverse(explode("/", $data['ref']))[0];
        $this->title = "[" . $data['repository']['name'] . "] " . "new Tag: " . $version;
        $this->img_url = $data['user_avatar'];
        $this->embedcontent .= "[" . mb_substr($data['after'], 0, 5) . "](" . $data['project']['web_url'] . ") " . $version;
    }
    public function getEmbedObject() {
        $embed = new Embed();
        return $embed->color($this->color)->title($this->title)->author($this->author)->description($this->embedcontent);
    }
}
