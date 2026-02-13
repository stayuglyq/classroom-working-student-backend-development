<?php declare(strict_types=1);
namespace App\Users;


class AdminUser extends UserBase 
{
    private const AccessLevel = 'ADMIN';
    
    public function __construct(string $name, string $email)
    {
        return parent::__construct($name, $email);
    }
    

}