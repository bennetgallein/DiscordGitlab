<?php
namespace DiscordGitlab\Types;

use \DiscordWebhooks\Embed;

class Commit {

    private $embedcontent;
    private $color = '3447003';
    private $author;
    private $title;
    private $url;
    private $img_url;

    public function __construct($data) {
        $this->embedcontent = "";
        $this->author = $data['user_name'];
        $branch = array_reverse(explode("/", $data['ref']))[0];
        $this->title = "[" . $data['repository']['name'] . ":" . $branch . "] " . $data['total_commits_count'] . " new commits.";
        $this->img_url = $data['user_avatar'];
        foreach ($data['commits'] as $commit) {
            $this->embedcontent .= "[" . mb_substr($commit['id'], 0, 5) . "](" . $commit['url'] . ") " . $commit['message'];
        }
    }
    public function getEmbedObject() {
        $embed = new Embed();
        return $embed->color($this->color)->title($this->title)->author($this->author)->description($this->embedcontent);
    }
}
