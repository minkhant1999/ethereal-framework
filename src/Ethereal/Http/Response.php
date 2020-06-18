<?php

namespace Ethereal\Http;

class Response
{
    protected $type = 'text/html';

    protected $status = 200;

    protected $headers = [];

    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function status(int $code = null)
    {
        if ($code) {
            $this->status = $code;
        }
        return $this->status;
    }

    public function setHeader(string $name, string $value)
    {
        $this->headers[] = "{$name}: {$value}";
    }

    public function setContentType($contentType)
    {
        $this->setHeader('Content-Type', $contentType);
    }

    public function send()
    {
        http_response_code($this->status);

        array_map(function ($header) {
            header($header, true);
        }, $this->headers);

        if (is_string($this->content)) {
            return print $this->content;
        }

        return is_object($this->content)  &&  method_exists($this->content, '__toString')
            ? print $this->content
            : print is_null($this->content) ? '' : json_encode($this->content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}