# discord-gitlab

This is a library to Discord and GitLab to have the same beautiful Notifications as GitHub has!

## Getting Started

You can either copy the PHP file directly into your project or _preferable_ just use composer.

## The Scope of this project

So this is a library for composer, right. I'm planning on building a Website that enables even unexperienced users to hook up Gitlab (and maybe other services) to Discord. But that's a thing for the future.

#### Composer require command
`composer require bennetgallein/discord-gitlab`

## Usage

It is fairly easy to use. I'll throw in an example.

```php
<?php
namespace DiscordGitlab;

include('vendor/autoload.php');

$input = file_get_contents('php://input');

$secret = "YOUR GITLAB SECRET HERE"; // If you didn't

$gitlab = new \DiscordGitlab\GitLab("WebhookURL_HERE", $input, $secret);

```
Now, just upload to a webserver and paste the file's path over at GitLab. And you are now receving Discord Notifications every time something gets pushed!

## Changelog
### v2.0
Push Event and Issues are now working as expected.
### v1.0
First release, enables Notifications for push Event.
## License

The project is MIT licensed. To read the full license, open [LICENSE.md](LICENSE.md).

## Contributing

Pull requests and issues are open!
