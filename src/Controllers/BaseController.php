<?php

namespace Controllers;

class BaseController
{
    protected $post;

    public function setPost(array $post)
    {
        $this->post = $post;
    }
}