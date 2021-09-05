<?php
namespace Base;

use App\Model\UserModel;

abstract class abstractController
{
    protected View $view;
    protected UserModel $user;

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

    /**
     * @param UserModel $user
     */
    public function setUser(UserModel $user): void
    {
        $this->user = $user;
    }

}