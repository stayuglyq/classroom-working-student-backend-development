<?php declare(strict_types=1);
namespace App\Interfaces;

interface Resettable
{
    /**
     * Summary of resetPassword
     * Reset user password.
     * @param string $newPassword
     * @return void
     */
    public function resetPassword(string $newPassword): void;
}