<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = DB::table('products')->get();
        $categories = DB::table('category')->get();
        $orders = DB::table('orders')->get();
        $mail = DB::table('admin_mail')->first()->email ?? null;
        return view('home', [
            "products" => $products,
            "orders" => $orders,
            "categories" => $categories,
            "mail" => $mail
        ]);
    }

    public function updateCat($id)
    {
        $name = $_POST['name'] ?? null;
        $desc = $_POST['desc'] ?? null;

        if(!empty($name)){
            DB::table('category')->where('id', $id)->update(['name' => $name, 'description' => $desc]);
            return back()->withInput();
        } else {
            die('Введено некоректное имя');
        }
    }

    public function addCat()
    {
        $name = $_POST['name'] ?? null;
        $desc = $_POST['desc'] ?? null;

        if(!empty($name)){
            DB::table('category')->insert(["name" => $name, "description" => $desc]);
            return back()->withInput();
        } else {
            die('Введено некоректное имя');
        }
    }

    public function deleteCat($id)
    {
        DB::table('category')->delete($id);
        return back()->withInput();
    }

    public function updateProd($id)
    {
        $name = $_POST['name'] ?? null;
        $price = $_POST['price'] ?? null;
        $desc = $_POST['desc'] ?? null;
        $category = $_POST['cat'] ?? null;
        $fileName = $_FILES['file']['name'] ?? null;

        if($fileName){
            request()->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            $fileName = time().'.'.request()->file->getClientOriginalExtension();
            request()->file->move(public_path('img'), $fileName);
        }

        if(!empty($name) && !empty($price) && !empty($category)){
            DB::table('products')->where('id', $id)->update([
                'name' => $name,
                'description' => $desc,
                'price' => $price,
                'category' => $category,
                'image' => $fileName ?? DB::table('products')->where('id', $id)->image
            ]);
            return back()->withInput();
        } else {
            die('Введено некоректное данные');
        }
    }

    public function addProd()
    {
        // echo 1;
        $name = $_POST['name'] ?? null;
        $price = $_POST['price'] ?? null;
        $desc = $_POST['desc'] ?? null;
        $category = $_POST['cat'] ?? null;
        $fileName = $_FILES['file']['name'] ?? null;

        if($fileName){
            request()->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            $fileName = time().'.'.request()->file->getClientOriginalExtension();
            request()->file->move(public_path('img'), $fileName);
        }

        if(!empty($name) && !empty($price) && !empty($category)){
                DB::table('products')->insert([
                    'name' => $name,
                    'description' => $desc,
                    'price' => $price,
                    'category' => $category,
                    'image' => $fileName
                ]);
                return back()->withInput();
        } else {
            die('Введено некоректное данные');
        }
    }

    public function deleteProd($id)
    {
        DB::table('products')->delete($id);
        return back()->withInput();
    }

    public function changeMail()
    {
        $email = $_POST['email'] ?? null;

        if(!empty($email)){
            if(count(DB::table('admin_mail')->get()) > 0){
                DB::table('admin_mail')->where('id', 1)->update(['email' => $email]);
            } else{
                DB::table('admin_mail')->insert(['email' => $email]);   
            }
            return back()->withInput();
        } else {
            die('Введено некоректное данные');
        }
    }
}
