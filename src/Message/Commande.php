<?php
 namespace App\Message;

    class Commande

    {
        private $titreLivre;
        private $email;

        public function __construct(string $titreLivre, $email,)
        {
            $this->titreLivre = $titreLivre;
            $this->email = $email;
        }
        public function getTitreLivre(): string
        {
            return $this->titreLivre;
        }
        public function getEmail(): string
        {
            return $this->email;
        }
    }
