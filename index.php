<?php
require "./vendor/autoload.php";

use Repo\ParseURI;
use Repo\Server;

// Repository folder
$repository = "repository";

// Servers
// if the value is true, stores the file in the local repository.
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
        echo "Not Found";

        die();
    } else {
        http_response_code(200);
        header("location: " . $file);

        die();
    }
}
