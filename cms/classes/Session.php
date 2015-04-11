<?php

class Session {
    var $started=false;

    function Session() {
        ini_set('session.only_cookies',true);
    }

    function start () {
        session_start();
        $this->started=true;
    }

    function setvalue ($key, $value) {
        if (!$this->started)
            $this->start();
        $_SESSION[$key]=$value;
    }

    function getvalue ($key, $default=false) {
        if (!$this->started)
            $this->start();
		if(isset($_SESSION[$key])){
		 return $_SESSION[$key];
		}
    }

    function unsetvalue ($key) {
        if (!$this->started)
            $this->start();
        unset($_SESSION[$key]);
    }

}