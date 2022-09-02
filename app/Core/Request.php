<?php

namespace App\Core;

class Request
{
    /** Return site URL without GET arguments */
    public static function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /** Return request method */
    public static function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /** Return GET or POST (+ FILES) data from request */
    public static function getBody()
    {
        $body = [];

        if (self::getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        } else if (self::getMethod() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if (count($_FILES) !== 0) {
            $body = array_merge($body, $_FILES);
        }

        return $body;
    }
}