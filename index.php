<?php
require "./vendor/autoload.php";

use Repo\ParseURI;
use Repo\Server;

$repository = "repository";
$servers = [
    "https://repo1.maven.org/maven2/" => false,
    "http://maven.adorilabs.com:8081/artifactory/gradle-release/" => false,
    "https://dl.google.com/dl/android/maven2/" => true
];

$parser = new ParseURI($repository);

if ($parser->home()) {
    echo "Default Webpage!";
} else {
    $server = new Server($servers, $parser);

    if ($server->cached()) {
        header("location: ". $server->cachedFile);
        die();
    } else {
        $file = $server->search();

        if (! $file) {
            http_response_code(404);
            echo "Not found";
        } else {
            http_response_code(200);
            header("location: " . $file);
        }
    }
}
