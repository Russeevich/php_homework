<?php
namespace Base;

class View
{
    private string $templatePath = "";
    private array $data = [];

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
}