<?php

namespace App\Http\Controllers;

use App\Models\Admin_mail;
use App\Models\Category;
use App\Models\Orders;
use App\Models\Products;
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
        $products = Products::get();
        $categories = Category::get();
        $orders = Orders::get();
        $mail = Admin_mail::first()->email ?? null;
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
            Category::where('id', $id)->update(['name' => $name, 'description' => $desc]);
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
            Category::insert(["name" => $name, "description" => $desc]);
            return back()->withInput();
        } else {
            die('Введено некоректное имя');
        }
    }

    public function deleteCat($id)
    {
        Category::where('id', $id)->delete($id);
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
            Products::where('id', $id)->update([
                'name' => $name,
                'description' => $desc,
                'price' => $price,
                'category' => $category,
                'image' => $fileName ?? Products::where('id', $id)->image
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
                Products::insert([
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
        Products::where('id', $id)->delete();
        return back()->withInput();
    }

    public function changeMail()
    {
        $email = $_POST['email'] ?? null;

        if(!empty($email)){
            if(count(Admin_mail::get()) > 0){
                Admin_mail::where('id', 1)->update(['email' => $email]);
            } else{
                Admin_mail::insert(['email' => $email]);   
            }
            return back()->withInput();
        } else {
            die('Введено некоректное данные');
        }
    }
}
