<?php
namespace Base;

class Route
{
    private $controllerName;
    private $actionName;
    private $processed = false;
    private $routes;

    public function process()
    {
        $parts = parse_url($_SERVER["REQUEST_URI"]);
        $path = $parts["path"];

        if(($route = $this->routes[$path] ?? null) !== null) {
            $this->controllerName = $route["controller"];
            $this->actionName = $route["action"];
        } else {
            $parts = explode("/", $path);
            $this->controllerName = "\\App\\Controller\\" . ucfirst(strtolower($parts[1]));
            $this->actionName = strtolower($parts[2] ?? "Index");
        }
    }

    public function addRoute($path, $controllerName, $actionName)
    {
        $this->routes[$path] = [
            "controller" => $controllerName,
            "action" => $actionName
        ];
    }

    public function getControllerName() : string
    {
        if(!$this->processed)
        {
            $this->process();
        }

        return $this->controllerName;
    }

    public function getActionName() : string
    {
        if(!$this->processed)
        {
            $this->process();
        }

        return $this->actionName . "Action";
    }
}