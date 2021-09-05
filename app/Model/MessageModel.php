<?php
namespace App\Model;

use Base\abstractModel;
use Base\DB;

class MessageModel extends abstractModel
{
    private string $text;
    private string $date;
    private int $owner_id;
    private ?string $image;

    public function __construct(string $text, int $owner_id, string $image)
    {
        $this->text = $text;
        $this->owner_id = $owner_id;
        $this->image = $image ?? null;
    }

    public function save() : bool
    {
        $db = DB::getInstance();

        try {
            $prepare_query = $db->
            getConnection()->
            prepare("INSERT INTO blog (`owner_id`, `text`, `image`) VALUES (:owner_id, :text, :image)");

            $prepare_query->bindParam(':owner_id', $this->owner_id);
            $prepare_query->bindParam(':text', $this->text);
            $prepare_query->bindParam(':image', $this->image);
            $prepare_query->execute();
        }catch (\Exception $e){
            return false;
        }

        return true;
    }

    public static function deleteMessageById(int $id) : bool
    {
        $db = DB::getInstance();

        try{
            $db->getConnection()
                ->query("DELETE FROM blog WHERE id = $id")
                ->execute();
        }catch(\Exception $e){
            return false;
        }
        return true;
    }

    public static function searchMessageByOwnerId(int $id, int $count): ?array
    {
        $db = DB::getInstance();

        $data = $db->
            getConnection()->
            query("SELECT * FROM blog WHERE owner_id = $id ORDER BY created_at DESC LIMIT $count")->
            fetchAll();

        if(!$data){
            return null;
        }

        return $data;
    }

    public static function getLastMessage(int $count) : array
    {
        $db = DB::getInstance();

        return $db->
            getConnection()->
            query("SELECT * FROM blog ORDER BY created_at DESC LIMIT $count")->
            fetchAll();
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getOwnerId(): int
    {
        return $this->owner_id;
    }


}