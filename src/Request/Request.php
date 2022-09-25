<?php

namespace Request;

/**
 * Class handling $_GET & $_POST requests
 */

class Request
{
    protected static ?Request $instance = null;

    private array $getData = [];
    private array $postData = [];
    private bool $isPost = false;

    public function __construct()
    {
        if (!empty($_GET)) {
            $this->getData = $_GET;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->postData = $_POST + $_FILES;
            $this->isPost = true;
        }
    }

    /**
     * Return true if the request is POST
     * 
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->isPost;
    }

    /**
     * Get $_POST data
     * 
     * @return array
     */
    public function getPostData(): array
    {
        return $this->postData;
    }

    /**
     * Get Request class instance
     */
    public static function getInstance(): Request
    {
        if (is_null(self::$instance)) {
            self::$instance = new Request();
        }

        return self::$instance;
    }

}