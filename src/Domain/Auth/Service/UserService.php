<?php

namespace App\Domain\Auth\Service;

use App\Domain\Auth\Event\UserCreatedEvent;
use App\Domain\Auth\Repository\UserRepository;
use App\Domain\Auth\User;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{

    public function __construct(private readonly  UserRepository $userRepository,
                                private readonly  UserPasswordHasherInterface $passwordHasher,
                                private readonly  EventDispatcherInterface $eventDispatcher)
    {
    }

    public function createUser(User $user): User
    {
        $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));

        $this->userRepository->save($user, true);
        $this->eventDispatcher->dispatch(new UserCreatedEvent($user));
        return $user;
    }
}