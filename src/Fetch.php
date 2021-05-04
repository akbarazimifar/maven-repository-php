<?php

namespace Repo;

use Repo\ParseURI;

class Fetch
{
    /**
     * Create a new instance.
     * 
     * @param  string  $url
     * @param  string  $path
     * @param \Repo\ParseURI $parser
     */
    public function __construct(private string $url, private string $path, private ParseURI $parser)
    {
        //
    }

    /**
     * Fetch the file and store.
     * 
     * @return string|bool
     */
    public function fetch(): string|bool
    {
        $saveAs = join_string($this->parser->repository, $this->path);

        $file = @file_get_contents($this->url);

        if (! $file)
            return false;

        mkdir(dirname($saveAs), 0755, true);

        file_put_contents($saveAs, $file);

        return "/" . join_string($this->parser->directory, $saveAs);
    }
}
