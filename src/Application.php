<?php
namespace Base;

use App\Controller\Blog;
use App\Controller\UserController;
use App\Model\User;
use JetBrains\PhpStorm\Pure;

class Application
{
    private Route $route;
    private $controller;
    private string $actionName;

    #[Pure] public function __construct()
    {
        $this->route = new Route();
    }

    public function run() : void
    {
        try {
            session_start();

            $this->addRoutes();

            $this->initController();

            $this->initAction();

            $this->initUser();

            $view = new View();

            $this->controller->setView($view);

            $content = $this->controller->{$this->actionName}();

            echo $content;
        }catch (RedirectException $e){
            header('Location: ' . $e->getUrl());
        }catch (RouteException $e){
            header("HTTP/1.0 404 Not Found");
            echo $e->getMessage();
        }
    }

    /**
     * @throws RouteException
     */
    private function initController() : void
    {
        $controllerName = $this->route->getControllerName();

        if(!class_exists($controllerName)) {
            throw new RouteException('Cant find class of controller' . $controllerName);
        }

        $this->controller = new $controllerName();
    }

    /**
     * @throws RouteException
     */
    private function initAction() : void
    {
        $action = $this->route->getActionName();

        if(!method_exists($this->controller, $action)){
            throw new RouteException("Action " . $action . " not found in " . get_class($this->controller));
        }

        $this->actionName = $action;
    }

    private function initUser() : void
    {
        $id = $_SESSION["id"] ?? null;

        if($id){
            $user = User::getById($id);
            if($user){
                $this->controller->setUser($user);
            }
        }
    }

    private function addRoutes() : void
    {
        $this->route->addRoute('/user/login', UserController::class, 'login');

        $this->route->addRoute('/user/register', UserController::class, 'register');

        $this->route->addRoute('/blog/api/user', Blog::class, 'searchMessage');

        $this->route->addRoute('/blog/add', Blog::class, 'addMessage');

        $this->route->addRoute('/blog/delete', Blog::class, 'deleteMessage');
    }
}