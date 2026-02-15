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
    public string $role;

    //Roles
    public const ROLE_ADMIN = 'ADMIN';
    public const ROLE_CUSTOMER = 'CUSTOMER';

    protected static int $counter = 0;


    public function __construct(string $name, string $email, string $role)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->role = $role;

        self::$counter++;
    }

    /**
     * String representation of the user for display and logging.
     * Structured as key=value pairs for easy parsing and log aggregation.
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            '[%s] name=%s email=%s role=%s',
            (new \ReflectionClass($this))->getShortName(),
            $this->getName(),
            $this->getEmail(),
            $this->role
        );
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
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return;
        }
        throw new InvalidArgumentException("Invalid email adress.");
    }


    public function getCounter(): int
    {
        return self::$counter;
    }

    /**
     * User data as associative array (key => value).
     * Appropriate for serialization, API responses, or keyed access by field name.
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->getEmail(),
            'role'  => $this->role,
        ];
    }
}