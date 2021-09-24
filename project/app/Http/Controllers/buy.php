<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\Mail;

class buy extends Controller
{
    public function buy($id)
    {
        $email = $_POST['email'] ?? null;

        if(!empty($email)){
            Orders::insert([
                "email" => $email,
                "product" => $id
            ]);

            Mail::send(
                [
                    "html" => "mail"
                ], 
                [
                    "email" => $email, 
                    "game" => Products::where('id', $id)->first()->name
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
