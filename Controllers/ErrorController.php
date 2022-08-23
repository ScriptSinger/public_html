<?php

namespace Controllers;

class ErrorController extends BaseController
{
    public function  notFoundAction()
    {
        return $this->generateError(404);
    }
}
