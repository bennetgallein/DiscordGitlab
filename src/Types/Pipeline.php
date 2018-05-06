<?php
namespace DiscordGitlab\Types;

use \DiscordWebhooks\Embed;

class Pipeline {

    private $embedcontent;
    private $color = '55040';

    private $status;
    private $project;
    private $buildstage;
    private $buildstatus;
    private $duration;

    public function __construct($data) {
        $this->status = $data['object_attributes']['status'];
        $this->project = $data['project']['name'];
        $this->buildstage = $data['builds'][0]['stage'];
        $this->buildstatus = $data['builds'][0]['status'];
        $this->createdat = $data['object_attributes']['created_at'];
        $this->duration = $data['object_attributes']['duration'];
    }
    public function getEmbedObject() {
        $embed = new Embed();
        if ($this->status == "success") {
            $this->color = "55040";
        } else {
            $this->color = "16745216";
        }
        $title = "Build Notification for: " . $this->project;
        return $embed->color($this->color)->title($title)->author("GitLab Pipeline Bot")->description($this->buildstatus . "\n" . $this->createdat . "\n" . "Duration: " . $this->duration);
    }
}
