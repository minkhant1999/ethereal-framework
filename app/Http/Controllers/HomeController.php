<?php

namespace App\Http\Controllers;

use PDO;

class HomeController extends Controller
{
    public function index()
    {
        return [
            'a' => 'Hello World',
            'foo' => 'Hello Bar',
            'b' => 'Hello Somewhere'
        ];
    }

    public function login()
    {
        // 
    }

    public function register()
    {
        return db()->query('SELECT * FROM user')->fetchAll(PDO::FETCH_CLASS, \App\User::class);
    }

    public function dashboard()
    {
        // $data = Arr::replace([
        //     'username' => null,
        //     'password' => null,
        //     'email' => null
        // ], $_POST);
        // extract($data);

        // $username = $_POST['username'] ?? null;
        // $password = $_POST['password'] ?? null;
        // $email = $_POST['email'] ?? null;

        return 'Hi';
    }
}