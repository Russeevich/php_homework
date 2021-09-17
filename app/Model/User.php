<?php
namespace App\Model;

use App\Controller\UserController;
use Base\abstractController;
use Base\abstractModel;

class User extends abstractModel
{
    protected $table = "users";
    public $timestamps = false;
    protected $fillable = ["name", "email", "id", "password", "date", "role", "image"];

    public static function getById(int $id) : ?self
    {
        $data = self::where('id', '=', $id)->firstOrFail();

        if(!$data){
            return null;
        }

        return $data;
    }

    public static function getByEmail(string $email) : ?self
    {
        $data = self::where('email', '=', $email)->firstOrFail();

        if(!$data){
            return null;
        }

        return $data;
    }

    public static function getAllUsers() : array|\Illuminate\Database\Eloquent\Collection|null
    {
        $data = self::all();

        if(!$data){
            return null;
        }

        return $data;
    }

    public static function getPasswordHash(string $password) : string
    {
        return sha1(PASS_SALT . $password);
    }
}
    