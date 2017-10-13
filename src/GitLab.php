<?php
namespace DiscordGitlab;

use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

use \DiscordGitlab\Types\Commit;
use \DiscordGitlab\Types\Issue;
use \DiscordGitlab\Types\PullReq;

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
        if (isset($action['object_kind'])) {
            if ($action['object_kind'] === "issue") {
                $embed = new Issue($action);
            }
            if ($action['object_kind'] === "merge_request") {
                $embed = new PullReq($action);
            }
        }
        $webhook->username("GitLab Webhook")->embed($embed->getEmbedObject())->send();
    }
}
