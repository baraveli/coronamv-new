<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{    
    /**
     * index
     * 
     *  Return all the users
     *
     * @return void
     */
    public function index()
    {
        return User::all()->toArray();
    }
}
