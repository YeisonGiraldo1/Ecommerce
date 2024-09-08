<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function allusers(Request $request)
    {
     $users = User::all();
     return view('users.index',compact('users'));
    }

}
