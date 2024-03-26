<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserList extends Controller
{
   public function AllUser(){
    $users = User::all();
    return view("users",compact("users"));
   }
}
