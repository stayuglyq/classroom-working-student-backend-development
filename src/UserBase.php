<?php declare(strict_types=1);

namespace App\Users;

use App\Interfaces\Resettable;
use InvalidArgumentException;

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

    //Roles
    public const ROLE_ADMIN = 'ADMIN';
    public const ROLE_CUSTOMER = 'CUSTOMER';

    protected static int $counter = 0;


    public function __construct(string $name, string $email)
    {
        $this->setName($name);
        $this->setEmail($email);

        self::$counter++;
    }

    /**
     * Magic get method.
     * @param string $propertyName
     * @throws InvalidArgumentException
     */
    public function __get(string $propertyName) 
    {
        if (property_exists($this, $propertyName)) {
            return $this->$propertyName;
    }
    throw new InvalidArgumentException("Property {$propertyName} does not exist.");
    }

    /**
     * Magic set method.
     * @param string $propertyName
     * @param mixed $propertyValue
     * @throws InvalidArgumentException
     * @return void
     */
    public function __set(string $propertyName, $propertyValue){
        if (property_exists($this, $propertyName)) {
            $this->$propertyName = $propertyValue;
            return;
        }
        throw new InvalidArgumentException("Property {$propertyName} does not exist.");
    }
    
    /**
     * Name getter.
     * @return string
     */
    public function getName(): string{  
        return $this->name;
    }

    /**
     * Name setter.
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    /**
     * Email getter.
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    /**
     * Email setter.
     * @param string $email
     * @return void
     */

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCounter(): int
    {
        return self::$counter;
    }


}