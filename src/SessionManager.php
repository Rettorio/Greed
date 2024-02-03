<?php

namespace Core;

use App\Model\Session;
use Config\Application;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

Class SessionManager {
    static private $SECRET_KEY = "SECRET321123";
    static private $TOKEN_ALG = "HS256";

    static private function main() :Model
    {
        $main = new Session;
        return $main;
    }

    static public function setSession(array $payload, int|null $userId = null) :void
    {
        $sessId = self::makeId(10);
        $payload['session_id'] = $sessId;
        $jwt = JWT::encode($payload, self::$SECRET_KEY, self::$TOKEN_ALG);

        $set = [
            "name" => "X-SESSION",
            "value" => $jwt,
            "expires_or_options" => time() + Application::COOKIE_EXPIRE,
            "httponly" => true
        ];


        setcookie(...$set);
        self::main()->insert([
            'session_id' => $sessId,
            'user_id' => $userId,
            'expire_date' => date("Y-m-d H:i:s", time() + Application::COOKIE_EXPIRE)
        ]);
    } 
    
    static private function makeId(int $length) :string
    {
        return bin2hex(random_bytes($length));
    }

    static public function wipe() :void
    {
        $body = self::getSession();
        if(!is_null($body)) { self::main()->DB()->query("DELETE FROM session WHERE session_id = '$body->session_id'"); }
        setcookie("X-SESSION", "", time() - 3600);
    }

    static public function Auth() :stdClass
    {
        $session = self::getSession();

        $auth = new stdClass;
        if(!is_null($session)) {
            $auth->ok = !empty(self::main()->select()->where("session_id", "=", $session->session_id)
                                                    ->where("expire_date", ">", date('Y-m-d H:i:s'))
                                                    ->get());
        } else { $auth->ok = false; }
        $auth->body = $session;

        return $auth;
    }

    static private function getSession() :stdClass|null
    {
        if(@$_COOKIE['X-SESSION']) {
            $token = $_COOKIE['X-SESSION'];
            $body = JWT::decode($token, new Key(self::$SECRET_KEY, self::$TOKEN_ALG));
            return $body;
        } else {
            return null;
        }
    }

    static public function setCsrfToken() :void
    {
        // $token = 
    }
}