<?php
namespace Base;

use App\Model\User;

abstract class abstractController
{
    protected View $view;
    protected User $user;

    /**
     * @throws RedirectException
     */
    protected function redirect(string $url): void
    {
        throw new RedirectException($url);
    }

    /**
     * @param View $view
     */
    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function uploadFile($file) : void
    {
        if($file['name']) {
            $filePath = UPLOAD_FULL_PATH . $file['name'];

            if (!mkdir($concurrentDirectory = UPLOAD_FULL_PATH) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }

            if(move_uploaded_file($file['tmp_name'], $filePath)){
                echo 'Файл успешно загружен';
            } else{
                echo 'Ошибка загрузки файла';
                die();
            }
        }
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}