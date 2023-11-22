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
     * Get client's IP address
     *
     * @return string
     */
    public static function getClientIpAddrress(): string 
    {
        return $_SERVER["REMOTE_ADDR"];
    }

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
     * Get request GET body
     *
     * @return array
     */
    public static function getGetRequestBody(): array 
    {
        $getBody = [];

        if (sizeof($_GET) !== 0) {
            foreach ($_GET as $key => $value) {
                $getBody[$key] = $value;
            }
        }

        return $getBody;
    }

    /**
     * Get request POST body
     *
     * @return array
     */
    public static function getPostRequestBody(): array 
    {
        $postBody = [];

        if (sizeof($_POST) !== 0) {
            foreach ($_POST as $key => $value) {
                $postBody[$key] = $value;
            }
        }

        return $postBody;
    }

    /**
     * Get request upload body
     *
     * @return array
     */
    public static function getUploadBody(): array 
    {
        $uploadBody = [];

        if (sizeof($_FILES) !== 0) {
            foreach ($_FILES as $key => $value) {
                $uploadBody[$key] = $value;
            }
        }

        return $uploadBody;
    }
}
