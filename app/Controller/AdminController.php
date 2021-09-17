<?php
namespace App\Controller;

use App\Model\User;
use Base\abstractController;

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
        if(!$_SESSION['id']){
            $this->redirect('/user/login');
        }

        if($this->user->role !== ADMIN_ROLE){
            $this->redirect('/blog/index');
        }

        return $this->view->render("admin/admin.phtml", [
            "users" => User::getAllUsers()
        ]);
    }

    function changeAction()
    {
        if(!$_SESSION['id']){
            $this->redirect('/user/login');
        }

        if($this->user->role !== ADMIN_ROLE){
            $this->redirect('/blog/index');
        }

        $id = $_POST['id'];
        $findUser = count(User::query()->where('email', '=', $_POST['email'])->get());

        if(!$findUser) {
            $this->setUserData(array_merge($_POST, $_FILES), User::query()->find($id))->save();
            $this->redirect('/admin');
        } else {
            echo 'Пользователь с таким email уже существует';
        }
    }

    function addAction()
    {
        if(!$_SESSION['id']){
            $this->redirect('/user/login');
        }

        if($this->user->role !== ADMIN_ROLE){
            $this->redirect('/blog/index');
        }

        $findUser = count(User::query()->where('email', '=', $_POST['email'])->get());

        if(!$findUser) {
            $this->setUserData(array_merge($_POST, $_FILES), new User)->save();
            $this->redirect('/admin');
        } else {
            echo 'Пользователь с таким email уже существует';
        }
    }
}