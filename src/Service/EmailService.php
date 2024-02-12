<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class EmailService
{
    public function sendEmail($toEmailAddress, MailerInterface $mailer)
    {
        $email = (new Email()) // (new Email())
        ->from('ro-reply@snowtricks.com')
        ->to($toEmailAddress)
        ->subject("Inscription dans le site snwotricks")
        ->text("Ceci est le lien de confirmation de compte");
        
        // rediriger vers une autre page
        $dsn = 'smtp://mailpit:1025';
        $transport = Transport::fromDsn($dsn);
        
        $mailer->send($email);

        return new HttpFoundationResponse("Email sent");
    }

      // $email = new TemplatedEmail();
            // $email->from('ro-reply@ntimba.me')
            //       ->to($user->getEmail())
            //       ->subject("Confirmation de votre inscription sur" . $siteUrlWithoutScheme)
            //       ->htmlTemplate('emails/_email_user_validation.html.twig')
            //       ->context([
            //         'siteUrl' => $siteUrlWithoutScheme,
            //         'fullname' => $user->getFirstname() .' '. $user->getLastname(),
            //         'confirmLink' => $confirmLink
            //       ]);

            // $mailer->send($email);
    
}

