<?php

namespace Core;

class Response
{
    public function     __construct(
        private readonly mixed $body,
        private readonly int   $statusCode = 200,
        private readonly array $headers = [],
    )
    {

    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        if (! empty($this->headers)) {
            foreach ($this->headers as $index => $value) {
                header("$index:$value");
            }
        }

        echo $this->body;
    }
}