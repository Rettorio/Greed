<?php

namespace App\Controller;

use App\Model\User;
use Config\Application;
use Core\Controller;
use Core\Password;
use Core\View;
use Core\Request;
use Core\Router;
use Core\SessionManager;

Class AuthController extends Controller {

    static public function LoginPage()
    {
        View::render('login', [], false);
    }

    static public function RegisterPage()
    {
        View::render('register', [], false);
    }

    static public function Login(Request $request)
    {
        if(!$request->validateEmpties(['Email', 'Password']))
        {

            $data = $request->all();
            $user = new User;
            @$check = $user->select(['id', 'Email', 'Nama', 'Password'])->where('Email', '=', $data['Email'])->getFirst();

            if(!empty($check) && Password::check($data['Password'], $check['Password']))
            {
                $uid = $check['id'];
                $payload = [
                    'username' => $check['Nama']
                ];
                SessionManager::setSession($payload, $uid);
                Router::back(Application::DEFAULT_ROUTE);
            }

        }
        Router::back();

    }

    static public function Logout()
    {
        SessionManager::wipe();
        Router::back("/");
    }

    static public function Register(Request $request)
    {
        $user = new User;
        $checkEmail = $user->select(['Email'])->where('Email', '=', $request->input("Email"))->get();
        if(!$request->validateEmpties(['Name', 'Email', 'Password']) && empty($checkEmail))
        {
            $data = $request->all();
            $hash = Password::make($data['Password']);
    
            $data['Password'] = $hash;
            $user->insert($data);
            Router::back('/login'); 
        }
        Router::back('/register');

    }
}