<?php

namespace Repo;

use Repo\ParseURI;
use Repo\Fetch;

class Server
{
    /**
     * The file url.
     * 
     * @var string
     */
    public string $url;

    /**
     * Create a new instance.
     * 
     * @param  array  $servers
     * @param  \Repo\ParseURI  $parser
     */
    public function __construct(private array $servers, private ParseURI $parser)
    {
        //
    }

    /**
     * Search for the file.
     * 
     * @return string|bool
     */
    public function search(): string|bool
    {
        $path = $this->parser->getFilePath();

        foreach ($this->servers as $server => $storable) {
            $url = join_string(trim($server, "/"), $path);

            if ($this->exists($url)) {

                if ($storable)
                    return $this->store($url, $path);

                return $url;
            }
        }

        return false;
    }

    /**
     * Check if the file exists in the repository both local/remote.
     * 
     * @param  string  $file
     * @return bool
     */
    private function exists(string $file): bool
    {
        $res = @fopen($file, "r");
        
        if ($res !== false) {
            fclose($res);
            return true;
        }

        return false;
    }

    /**
     * Store the file in the local repository.
     * 
     * @param  string  $url
     * @param  string  $path
     * @return string|bool
     */
    private function store(string $url, string $path): string|bool
    {
        $fetcher = new Fetch($url, $path, $this->parser);

        return $fetcher->fetch();
    }
}
