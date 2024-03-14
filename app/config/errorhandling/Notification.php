<?php

namespace app\config\errorhandling;

class Notification {

    protected $code; // 201 / 404 usw.
    protected $message;
    protected $type; //Success or error
    protected $redirect; //true or false
    protected $redirect_url;

    function __construct(string $type, string $message, int $code, bool $redirect, string $redirect_url)
    {
        $this->code = $code;
        $this->message = $message;
        $this->type = $type;
        $this->redirect = $redirect;
        $this->redirect_url = $redirect_url;
    }

    function getCode() {
        return $this->code;
    }

    function getMessage() {
        return $this->message;
    }

    function getType() {
        return $this->type;
    }

    function getRedirectUrl() {
        return $this->redirect_url;
    }

    function getRedirect() {
        return $this->redirect;
    }
}