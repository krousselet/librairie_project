<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;

class ActionVoter extends Voter
{
    public const EDIT = 'EDIT'; // ça, c'est pour l'édition des infos
    public const VIEW = 'VIEW'; // ça, c'est pour le visionnage des infos

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::VIEW])
            && $subject instanceof \App\Entity\User;
        // ça, ça vérifie qu'il y a bien un utilisateur de créé, et donc de connecté par la variable de session
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        // si l'utilisateur est anonyme (invité), ne pas autoriser l'accès
        if (!$user instanceof User) {
            return false;
        }

        // $post = $subject;

        // return match ($attribute) {
        //     self::VIEW => $this->canView($post, $user),
        //     self::EDIT => $this->canEdit($post, $user),
        //     default => throw new \LogicException('This code should not be reached!')
        // };

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                return $user->getId() === $subject->getId();
                break;
            case self::VIEW:
                // logic to determine if the user can VIEW
                // return true or false
                return $user->getId() === $subject->getId();
                break;
        }

        return false;
    }
}
