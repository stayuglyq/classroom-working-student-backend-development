<?php declare(strict_types= 1);

namespace App\Traits;

/**
 * 
 * This trait provides login/logout logic.
 * 
 */
 trait CanLogin
 {
    /**
     * Shows whether user is currently logged in.
     */
    protected bool $isLoggedIn = false;

    /**
     * Check LoggedIn state.
     * @return bool
     */
    public function isLoggedIn(): bool{
        return $this->isLoggedIn;
    }

    /**
     * Attempt to login user with easy validation.
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool{
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false ||
        strlen($password) <= 8) {
            return false;
        }
        else{
            $this->isLoggedIn = true;
            return true;
        }
    }

 }