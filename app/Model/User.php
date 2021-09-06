<?php
namespace App\Model;

use Base\abstractModel;
use Base\DB;

class User extends abstractModel
{
    private ?string $name;
    private ?int $id;
    private ?string $date;
    private ?string $email;
    private ?string $password;
    private ?int $role;

    public function __construct($data = [])
    {
        if ($data) {
            $this->name = $data['name'] ?? null;
            $this->email = $data['email'] ?? null;
            $this->id = $data['id'] ?? null;
            $this->password = $data['password'] ?? null;
            $this->date = $data['date'] ?? null;
            $this->role = $data['role'] ?? null;
        }
    }

    public static function getById(int $id) : ?self
    {
        $db = DB::getInstance();
        $query = "SELECT * FROM users WHERE id = $id";

        $data = $db->getConnection()->query($query)->fetch(\PDO::FETCH_ASSOC);

        if(!$data){
            return null;
        }

        return new self($data);
    }

    public static function getByEmail(string $email) : ?self
    {
        $db = DB::getInstance();

        $prepare_query = $db->getConnection()->prepare("SELECT * FROM users WHERE email = :email");

        $prepare_query->bindParam(':email',$email);

        $prepare_query->execute();

        $data = $prepare_query->fetch(\PDO::FETCH_ASSOC);

        if(!$data){
            return null;
        }

        return new self($data);
    }

    public function save() : bool
    {
        $db = DB::getInstance();

        try {
            $prepare_query = $db->
                getConnection()->
                prepare("INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)");

            $prepare_query->bindParam(':name', $this->name);
            $prepare_query->bindParam(':email', $this->email);
            $prepare_query->bindParam(':password', $this->password);
            $prepare_query->execute();
        }catch (\Exception $e){
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getName(): mixed
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDate(): mixed
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getEmail(): mixed
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword(): mixed
    {
        return $this->password;
    }

    /**
     * @return int|mixed|null
     */
    public function getRole(): mixed
    {
        return $this->role;
    }



    public static function getPasswordHash(string $password) : string
    {
        return sha1(PASS_SALT . $password);
    }
}
    