<?php
namespace App\Controller;

use App\Model\User;
use Base\abstractController;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends abstractController
{
    private function setUserData($data, User $user)
    {
        $password = trim($data['password']);
        $name = trim($data['name']);
        $email = trim($data['email']);
        $role = trim($data['role']);
        $image = $data['file']['name'];

        if (!empty($email)) {
            $user->email = $email;
        }

        if (!empty($role)) {
            $user->role = $role;
        }

        if (!empty($password)) {
            $user->password = User::getPasswordHash($password);
        }

        if (!empty($name)) {
            $user->name = $name;
        }

        if (!empty($image)) {
            $this->uploadFile($data['file']);
            $user->image = $image;
        }

        return $user;
    }

    function indexAction() : string
    {
        if(!array_key_exists('id', $_SESSION)){
            header('HTTP/1.1 404 Not Found');
            die('Пройдите авторизацию');
        }

        if($this->user->role !== ADMIN_ROLE){
            header('HTTP/1.0 403 Forbidden');
            die('Нет прав для доступа');
        }

        return $this->view->render("admin/admin.phtml", [
            "users" => User::getAllUsers()
        ]);
    }

    function changeAction()
    {
        if(!array_key_exists('id', $_SESSION)){
            header('HTTP/1.1 404 Not Found');
            die('Пройдите авторизацию');
        }

        if($this->user->role !== ADMIN_ROLE){
            header('HTTP/1.0 403 Forbidden');
            die('Нет прав для доступа');
        }

        $id = $_POST['id'];
        try{
            User::query()->where('email', '=', $_POST['email'])->firstOrFail();
            die('Такой пользователь уже существует');
        }catch(ModelNotFoundException $e){
            $saved = $this->setUserData(array_merge($_POST, $_FILES), User::query()->find($id))->save();
            if($saved){
                $this->redirect('/admin');
            } else {
                die('Ошибка обновления пользователя');
            }
        }
    }

    function addAction()
    {
        if(!array_key_exists('id', $_SESSION)){
            header('HTTP/1.1 404 Not Found');
            die('Пройдите авторизацию');
        }

        if($this->user->role !== ADMIN_ROLE){
            header('HTTP/1.0 403 Forbidden');
            die('Нет прав для доступа');
        }

        try{
            User::query()->where('email', '=', $_POST['email'])->firstOrFail();
            die('Такой пользователь уже существует');
        }catch(ModelNotFoundException $e){
            $saved = $this->setUserData(array_merge($_POST, $_FILES), new User)->save();
            if($saved){
                $this->redirect('/admin');
            } else {
                die('Ошибка создания пользователя');
            }
        }
    }
}