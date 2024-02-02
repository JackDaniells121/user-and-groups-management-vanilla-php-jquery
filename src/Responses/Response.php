<?php

namespace Responses;

class Response
{
    public function __construct(int $code, $data = null)
    {
        echo json_encode([
            'code' => $code,
            'data'=> $data
        ]);
    }
}