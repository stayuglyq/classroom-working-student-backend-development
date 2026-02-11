<?php
namespace App\Interfaces;

interface Resettable
{
    // function used to reset the state of the object
    public function reset(): void;
}