<?php

namespace App\Domain\Infrastructure\Mailing;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Mailer
{

    public function __construct(
        private readonly  Environment $twig,
        private readonly MailerInterface $mailer,
    )
    {
    }

    public function createEmail(string $templates, array $data= [] )
    {
        $this->twig->addGlobal('format', 'html');
        $html = $this->twig->render($templates, array_merge($data, ['layout' => 'mails/base.html.twig']));
        $this->twig->addGlobal('format', 'text');
        $text = $this->twig->render($templates, array_merge($data, ['layout' => 'mails/base.text.twig']));
        return (new Email())
            ->from(new Address('test@test.com', 'UnjourUnehistoire'))
            ->html($html)
            ->text($text);

    }

    public function send(Email $email): void
    {
        if (!$this->params->get('mail_enabled')) {
            return;
        }
        $this->mailer->send($email);
    }
}