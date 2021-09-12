<?php
namespace Base;

use App\Model\User;

class View
{
    private string $templatePath = "";
    private array $data = [];
    private $twig;

    public function __construct()
    {
        $this->templatePath = PROJECT_DIR . DIRECTORY_SEPARATOR . "app/View";
    }

    public function assign(string $type, string $value) : void
    {
        $this->data[$type] = $value;
    }

    public function render(string $tpl, $data = []) : string
    {
        $this->data += $data;
        ob_start();
        include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
        return ob_get_clean();
    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    public function renderTwig(string $tpl, array $data = []) : string
    {
        $this->data += $data;
        if(!$this->twig)
        {
            $loader = new \Twig\Loader\FilesystemLoader($this->templatePath);
            $this->twig = new \Twig\Environment($loader);
            $function = new \Twig\TwigFunction('getUserName',  function (int $id){
                return User::getById($id)->getName();
            });
            $this->twig->addFunction($function);
        }

        return $this->twig->render($tpl, $this->data);
    }
}