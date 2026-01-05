<?php

namespace lib;

class Sessions
{
    private function sessionID()
    {
        $id = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
        if (!isset($_SESSION[$id])) {
            $_SESSION[$id] = [];
        }
    
        return $id;
    }    

    public static function create($name, $value)
    {
        $i = new Self();
        $_SESSION[$i->sessionID()][$name] = $value;
        return true;
    }

    // Criar uma sessão temporaria até chamar get para apagar
    public static function cache($name, $value)
    {
        $i = new Self();
        $_SESSION[$i->sessionID()][$name] = ["cache" => $value];
        return true;
    }

    public static function all()
    {
        $i = new Self();
        $sessions = $_SESSION[$i->sessionID()];

        return $sessions;
    }

    public static function get($name)
    {
        $i = new Self();
        $sessions = $_SESSION[$i->sessionID()];
    
        if (isset($sessions[$name])) {
            $value = $sessions[$name];
            if (is_array($value) && isset($value["cache"])) {
                $e = $value["cache"];
                self::unset($name); // Remove cache
            } else $e = $value;
            return $e;
        }
    
        return false;
    }
    

    public static function unset($name)
    {
        $i = new Self();
    
        if (isset($_SESSION[$i->sessionID()][$name])) {
            unset($_SESSION[$i->sessionID()][$name]);
            return true;
        }
        return false;
    }
    

    public static function destroy()
    {
        $i = new Self();

        if (isset($_SESSION[$i->sessionID()])) {
            unset($_SESSION[$i->sessionID()]);
            return true;
        } else false;
    }
}
