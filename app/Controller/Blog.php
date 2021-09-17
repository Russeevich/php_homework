<?php
namespace App\Controller;

use App\Model\MessageModel;
use Base\abstractController;

class Blog extends abstractController
{
    public function indexAction(): string
    {
        if(!isset($_SESSION['id'])){
            $this->redirect("/user/login");
        }

        return $this->view->render("/Blog/blog.phtml", [
            "user" => $this->user,
            "messages" => MessageModel::getLastMessage(20)
        ]);
    }

    public function addMessageAction() : void
    {
        if(!isset($_SESSION['id'])){
            $this->redirect("/user/login");
        }

        $message = new MessageModel;

        $message->text = $_POST['text'];
        $message->owner_id = $this->user->id;
        $message->image = $_FILES['file']['name'];

        $this->uploadFile($_FILES['file']);

        $message->save();

        $this->redirect("/blog/index");
    }

    /**
     * @throws \Base\RedirectException
     */
    public function deleteMessageAction() : void
    {
        if(!isset($_SESSION['id']) || $this->user->role !== ADMIN_ROLE){
            $this->redirect("/user/login");
        }

        MessageModel::deleteMessageById($_POST['id']);

        $this->redirect("/blog/index");
    }

    /**
     * @throws \JsonException
     */
    public function searchMessageAction() : void
    {
         $user_id = $_GET['id'];

         $data = MessageModel::searchMessageByOwnerId($user_id, 20);

         if(count($data) > 0) {
             header('Content-Type: application/json');
             echo json_encode($data, JSON_THROW_ON_ERROR);
         } else {
             echo 'Записей не обнаружено!';
         }
    }
}