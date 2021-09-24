<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class buy extends Controller
{
    public function buy($id)
    {
        $email = $_POST['email'] ?? null;

        if(!empty($email)){
            DB::table('orders')->insert([
                "email" => $email,
                "product" => $id
            ]);

            Mail::send(
                [
                    "html" => "mail"
                ], 
                [
                    "email" => $email, 
                    "game" => DB::table('products')->where('id', $id)->first()->name
                ], 
                function($message){
                    $message->to('empiks18@gmail.com', 'To admin')->subject('Покупка на сайте');
                    $message->from('flyingtestmail@gmail.com', 'From site');
                }
            );

            return back()->withInput();
        } else {
            die('Вы не указали email');
        }
    }
}
