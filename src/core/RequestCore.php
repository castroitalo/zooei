<?php 

declare(strict_types=1);

namespace src\core;

/**
 * Class RequestCore
 * 
 * @package src\core
 */
class RequestCore
{
    /**
     * Get route requested URI
     *
     * @return string
     */
    public static function getRequestUri(): string 
    {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    /**
     * Get HTTP request method
     *
     * @return string
     */
    public static function getRequestHttpMethod(): string 
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    /**
     * Get uploaded file body
     *
     * @return array
     */
    public static function getUploadedFileBody(): array 
    {
        $fileBody = [];

        if (sizeof($_FILES) !== 0) {
            foreach ($_FILES as $key => $value) {
                $fileBody[$key] = $value;
            }
        }

        return $fileBody;
    }

    /**
     * Get request $_POST or $_GET body
     *
     * @return array
     */
    public static function getRequestBody(): array 
    {
        // Request body
        $body = [];

        // Get GET HTTP method body (query string)
        if (self::getRequestHttpMethod() === "GET") {
            if (sizeof($_GET) !== 0) {
                foreach ($_GET as $key => $value) {
                    $body[$key] = $value;
                }
            }
        }

        // Get POST HTTP method body (headers)
        if (self::getRequestHttpMethod() === "POST") {
            if (sizeof($_POST) !== 0) {
                foreach ($_POST as $key => $value) {
                    $body[$key] = $value;
                }
            }
        }

        return $body;
    }
}
