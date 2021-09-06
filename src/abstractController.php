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

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}