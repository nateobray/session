<?php

namespace obray;

if (!class_exists(\obray\oObject::class)) die();

/**
 * oSession
 *
 * Session Manager
 */
Class oSession
{
    /**
     * Get returns the entire session array
     * 
     * @return array
     */

    public function get()
    {
        if(\session_start()){
            $session = (object) $_SESSION;
            \session_write_close();
            return $session;
        }
        throw new \Exception("Unable to initialize session.",500);
    }

    /**
     * Destroy - destroys a session completely
     * 
     * @return void
     */

    public function destroy(){
        if(\session_start()){
            \session_destroy();
            \session_write_close();
            return;
        }
        throw new \Exception("Unable to initialize session.",500);
    }

    /**
     * Magic method the returns the property from the session array
     * 
     * @param string $name is the key in the sessino array to be returned
     * 
     * @return mixed
     */

    public function __get(string $name)
    {
        if(\session_start()){
            $value = NULL;
            if(array_key_exists($name, $_SESSION)) {
                $value = $_SESSION[$name];
            }
            \session_write_close();
            return $value;
        }
        throw new \Exception("Uanble to intialize session.",500);
    }

    /**
     * Magic method that sets a key in the session array
     * 
     * @param string $name is the key in the session array to set
     * @param mixed $value is the value to be assigned to the key
     * 
     * @return void
     */

    public function __set(string $name,$value)
    {
        
        if(\session_start()){
            $_SESSION[$name] = $value;
            $this->{$name} = $value;
            \session_write_close();
            return;
        }
        throw new \Exception("Uanble to intialize session.",500);
    }

    /**
     * Magic method to test if key is set in the session array
     * 
     * @param string $name is the key in the session array to test
     * 
     * @return bool
     */

    public function __isset(string $name)
    {
        if(\session_start()){
            $isSet = isSet($_SESSION[$name]);
            \session_write_close();
            return $isSet;
        }
        throw new \Exception("Uanble to intialize session.",500);
    }

    /**
     * Magic method to unset a key in the session array
     * 
     * @param string $name is the key in the session array to unset
     */

    public function __unset(string $name)
    {
        if(\session_start()){
            unset($_SESSION[$name]);
            \session_write_close();
            return;
        }
        throw new \Exception("Uable to intialize session.",500);
    }

}