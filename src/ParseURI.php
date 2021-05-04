<?php

namespace Repo;

class ParseURI
{
    /**
     * The file path.
     * 
     * @var string|null
     */
    private ?string $filePath = null;

    /**
     * The repository.
     * 
     * @var string
     */
    public string $repository;

    /**
     * The current directory.
     * 
     * @var string
     */
    public string $directory;

    /**
     * The uri.
     * 
     * @var string
     */
    private string $uri;
    
    /**
     * Create a new instance.
     * 
     * @param  string  $repository
     */
    public function __construct(string $repository)
    {
        $this->repository = trim($repository, "/");
        $this->directory = trim(dirname($_SERVER["PHP_SELF"]), "/");
        $this->uri = trim($_SERVER['REQUEST_URI'], "/");
    }

    /**
     * Indicates whether the current uri is the home page.
     * 
     * @return bool
     */
    public function home(): bool
    {
        return $this->directory === $this->uri;
    }

    /**
     * Get the file path.
     * 
     * @return string
     */
    public function getFilePath()
    {
        if ($this->filePath !== null)
            return $this->filePath;
    
        if (empty($this->directory))
            return $this->filePath = $this->uri;

        $length = strlen(join_string($this->directory, $this->repository));
        $realPath = substr($this->uri, $length);

        $this->filePath = trim($realPath, "/");

        return $this->filePath;
    }
}
