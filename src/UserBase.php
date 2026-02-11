<?php declare(strict_types=1);

namespace App\Users;

use App\Interfaces\Resettable;

// Abstract base for all users.
abstract class UserBase implements Resettable
{
    protected $id;
    protected $name;
    protected $email;


    public function __construct(string $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): string{
        return $this->id;
    }

    public function getName(): string{  
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}