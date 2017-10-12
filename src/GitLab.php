<?php
namespace DiscordGitlab;

use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

class GitLab {

    private $url;
    /**
     * @param string $url The Discord Webhook URL
     *
     */
    public function __construct($url, $input) {
        $this->url = $url;

        $action = json_decode($input, true);

        foreach ($action['commits'] as $commit) {
            $webhook = new Client($url);
            $embed = new Embed();

            $embed->description("```" . $commit['id'] . "```")->color("3447003*");
            $webhook->username("B-Hook")->message("New commit")->embed($embed)->send();
        }
    }
}
