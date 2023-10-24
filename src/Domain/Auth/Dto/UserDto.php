<?php

namespace App\Domain\Auth\Dto;

use App\Domain\Auth\User;

class UserDto
{

    public function __construct(public string $username,
                                public string $email,
                                public string $password,
                                public string $firstname,
                                public string $lastname)
    {
    }


    public function  toUser(): User
    {
        $user = new User();
        $user->setUsername($this->username);
        $user->setPassword($this->password);
        $user->setFirstname($this->firstname);
        $user->setLastname($this->lastname);
        return $user;
    }

}