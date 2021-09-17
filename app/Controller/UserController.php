<?php
namespace App\Controller;

use App\Model\User;
use Base\abstractController;

class UserController extends abstractController
{
    /**
     * @throws \Base\RedirectException
     */
    public function loginAction() : string
    {
        if(isset($_SESSION['id'])){
            $this->redirect("/blog/index");
        }

        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;

        if(isset($email, $password)){
            $user = User::getByEmail($email);

            if(!$user){
                $this->view->assign("error", "Пользователь или пароль неверны!");
            } else if($user->password !== User::getPasswordHash($password)) {
                $this->view->assign("error", "Пользователь или пароль неверны!");
            } else {
                $_SESSION["id"] = $user->id;

                $this->redirect("/blog/index");
            }
        }

        return $this->view->render("user/login.phtml");
    }

    /**
     * @throws \Base\RedirectException
     */
    public function registerAction() : string
    {
        if(isset($_SESSION['id'])){
            $this->redirect("/blog/index");
        }

        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;
        $repeat_password = $_POST["repeat_password"] ?? null;
        $name = $_POST["name"] ?? null;

        if(isset($email, $password, $repeat_password, $name)){
            $user = User::getByEmail($email);

            if($user){
                $this->view->assign("error", "Пользователь с таким email уже зарегистрирован!");
            }

            if(!$user) {
                if ($password !== $repeat_password) {
                    $this->view->assign("error", "Пароли не совпадают!");
                }
                else if (strlen($password) < 4) {
                    $this->view->assign("error", "Длина паролья должна быть больше 4х символов!");
                } else {
                    $user = new User([
                        "email" => $email,
                        "password" => User::getPasswordHash($password),
                        "name" => $name
                    ]);

                    $user->save();

                     $this->redirect("/blog/index");
                }
            }
        }

        return $this->view->render("user/register.phtml");
    }
}