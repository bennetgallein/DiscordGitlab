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
    public function __construct($url, $input, $secret = '') {

        $webhook = new Client($url);
        $secrettoken = isset($_SERVER['HTTP_X_GITLAB_TOKEN']) ? $_SERVER['HTTP_X_GITLAB_TOKEN'] : '';

        if ($secret !== $secrettoken) {
            $embed = new Embed();
            $embed->color('15158332')->title("ERROR!")->description("Your Tokens are not the same. Check them!");
            $webhook->username("ERROR")->embed($embed)->send();
            return;
        }
        $this->url = $url;
        $action = json_decode($input, true);

        if ($_SERVER['HTTP_X_GITLAB_EVENT'] === "Push Hook") {
            $embed = new Commit($action);
        }
        if ($_SERVER['HTTP_X_GITLAB_EVENT'] === "Issue Hook") {
            $embed = new Issue($action);
        }
        if ($_SERVER['HTTP_X_GITLAB_EVENT'] === "Merge Request Hook") {
            $embed = new PullReq($action);
        }
        $webhook->embed($embed->getEmbedObject())->send();
    }
}
