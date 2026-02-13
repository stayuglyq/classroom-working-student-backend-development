<?php declare(strict_types=1);
namespace App\Users;

use App\Interfaces\Resettable;



class CustomerUser extends UserBase implements Resettable 
{
    private const AccessLevel = 'CUSTOMER';
    
    
    public function __construct(string $name, string $email)
    {
        return parent::__construct($name, $email);
    }

    public function resetPassword(string $newPassword): void
    {
        $this->password = $newPassword;
    }

    
}