<?php
namespace App\Model;

use Base\abstractModel;

class MessageModel extends abstractModel
{
    protected $table = "blog";
    public $timestamps = false;
    protected $fillable = ["text", "date", "owner_id", "image"];

    public static function deleteMessageById(int $id) : bool
    {
        try{
            self::all()->find($id)->deleteOrFail();
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }

    public static function searchMessageByOwnerId(int $id, int $count): array|\Illuminate\Database\Eloquent\Collection|null
    {

        $data = self::all()->where('owner_id', '=', $id)->sortByDesc('created_at')->take($count);

        if(!$data){
            return null;
        }

        return $data;
    }

    public static function getLastMessage(int $count) : array|\Illuminate\Database\Eloquent\Collection|null
    {
        return self::all()->sortByDesc('created_at')->take($count);
    }
}