<?php

namespace Skeleton\SkeletonPhpApplication\Core;

class Response
{
    protected $data;
    protected $status = 200;
    protected $headers = [];

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function status($status)
    {
        $this->status = $status;
        return $this;
    }

    public function header($key, $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function json($data = null)
    {
        if ($data !== null) {
            $this->data = $data;
        }

        header('Content-Type: application/json');
        http_response_code($this->status);

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }

        echo json_encode($this->data);
        exit;
    }
}
