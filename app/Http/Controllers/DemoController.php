<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function publicMessage(){
        return response()->json(['message' => 'This is a public message.']);
    }
    public function protectedMessage(){
        return response()->json(['message' => 'This is a protected message.']);
    }
    public function secratMessage(){
        return response()->json(['message' => 'This is a secrat message.']);
    }
    public function loginUser(){
      return response()->json(['message' => 'This is a login message.']);  
    }

}
