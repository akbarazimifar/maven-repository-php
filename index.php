<?php
set_time_limit(0);

require "./vendor/autoload.php";

use Repo\ParseURI;
use Repo\Server;

// Repository folder
$repository = "repository";

// Servers
$servers = [
    "https://repo1.maven.org/maven2/" => false,
    "https://dl.google.com/dl/android/maven2/" => true
];

$parser = new ParseURI($repository);

if ($parser->home()) {
    die("Default Webpage!");
} else {
    $server = new Server($servers, $parser);
    $file = $server->search();

    if (! $file) {
        http_response_code(404);

        die("Not Found");
    } else {
        http_response_code(200);
        header("location: " . $file);

        die();
    }
}
