<?php

class Hash
{

    public static function make($string, $salt = '')
    {
        return hash('sha256', $string . $salt);
    }

    public static function salt($length)
    {
        return mcrypt_create_iv($length);
    }

    public static function active(){
        return md5(uniqid(rand(), true));
    }

    public static function unique()
    {
        return self::make(uniqid());
    }

}

?>