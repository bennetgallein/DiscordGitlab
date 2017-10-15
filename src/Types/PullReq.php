<?php
namespace DiscordGitlab\Types;

use \DiscordWebhooks\Embed;

class PullReq {

    private $embedcontent;
    private $color = '3066993';
    private $author;
    private $title;
    private $url;

    public function __construct($data) {
        $this->author = $data['user']['name'];
        if ($data['object_attributes']['action'] === "open") {
            $this->color = '3066993';
            $this->title = "new Merge request: " . $data['object_attributes']['id'];
        }
        if ($data['object_attributes']['action'] === "closed") {
            $this->color = '8359053';
            $this->title = "closed Merge request: " . $data['object_attributes']['id'];
        }
        $this->embedcontent = "[" . $data['object_attributes']['target']['name'] . "](" . $data['object_attributes']['url'] . "):" . $data['object_attributes']['id'] . " - " . $data['object_attributes']['title'];
    }
    public function getEmbedObject() {
        $embed = new Embed();
        return $embed->color($this->color)->title($this->title)->author($this->author)->description($this->embedcontent);
    }
}
