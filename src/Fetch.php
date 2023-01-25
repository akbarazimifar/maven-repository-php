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

        $file = $this->curl($this->url);

        if (! $file)
            return false;

        mkdir(dirname($saveAs), 0755, true);

        file_put_contents($saveAs, $file);

        return "/" . join_string($this->parser->directory, $saveAs);
    }
    
    /**
     * Get contents using curl.
     *
     * @param  string  $url
     * @return string
     */
    private function curl(string $url): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
