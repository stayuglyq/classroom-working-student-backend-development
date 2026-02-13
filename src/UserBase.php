<?php declare(strict_types=1);

namespace App\Users;

use App\Interfaces\Resettable;

/**
 * Abstract base for all users.
 * Base class does NOT implement Resettable.
 * Password reset capability is considered a specific behavior
 * and is only implemented by CustomerUser.
**/
abstract class UserBase 
{
    protected $name;
    private $email;
    protected $password;


    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }


    public function getName(): string{  
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}