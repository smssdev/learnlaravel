<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $users = [
            ['id' => 1, 'name' => 'Solayman'],
            ['id' => 2, 'name' => 'Ahmed'],
            ['id' => 3, 'name' => 'Rami'],
            ['id' => 4, 'name' => 'Mousab'],
            ['id' => 5, 'name' => 'Wesam'],
            ['id' => 6, 'name' => 'Omar'],
        ];
        foreach($users as $user) {
            echo $user['id'] . '- ' . $user['name'] . "\n";
        }
    }
}
