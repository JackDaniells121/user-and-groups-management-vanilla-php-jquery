<?php

namespace Controllers;

class BaseController
{
    public $post;

    public function setPost(array $post)
    {
        $this->post = $post;
    }
}