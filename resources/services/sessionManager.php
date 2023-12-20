<?php

class sessionManager {
    public function startSession() {
        session_start();
    }
    public function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }
    public function unsetSession($key) {
        unset($_SESSION[$key]);
    }
    public function getSession($key) {
        return !empty($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    public function destroySession() {
        session_destroy();
    }
}