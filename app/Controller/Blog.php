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

        $message = new MessageModel($_POST['text'], $this->user->getId(), $_FILES['file']['name']);

        if($_FILES['file']) {
            $file = $_FILES['file'];
            $filePath = UPLOAD_FULL_PATH . $file['name'];

            if(move_uploaded_file($file['tmp_name'], $filePath)){
                echo 'Файл успешно загружен';
            } else{
                echo 'Ошибка загрузки файла';
            }
        }


        $message->save();

        $this->redirect("/blog/index");
    }

    /**
     * @throws \Base\RedirectException
     */
    public function deleteMessageAction() : void
    {
        if(!isset($_SESSION['id']) || $this->user->getRole() !== ADMIN_ROLE){
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

         if($data) {
             header('Content-Type: application/json');
             echo json_encode(MessageModel::searchMessageByOwnerId($user_id, 20), JSON_THROW_ON_ERROR);
         } else {
             echo 'Записей не обнаружено!';
         }
    }
}