<?php

namespace Core;


Class Password {
    static private $options = [
        'cost' => 5
    ];

    static public function make(string $pwd) :string
    {
        return password_hash($pwd, PASSWORD_DEFAULT, self::$options);
    }

    static public function check(string $inputPwd, $storedHash) :bool
    {
        return password_verify($inputPwd, $storedHash);
    }
}