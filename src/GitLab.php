<?php
namespace DiscordGitlab;

use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

use \DiscordGitlab\Types\Commit;

class GitLab {

    private $url;
    /**
     * @param string $url The Discord Webhook URL
     *
     */
    public function __construct($url, $input) {
        $this->url = $url;
        $action = json_decode($input, true);

        $webhook = new Client($url);

        if (isset($action['commits'])) {
            $embed = new Commit($action);
        }
        $webhook->username("GitLab Webhook")->embed($embed->getEmbedObject())->send();
    }
}
