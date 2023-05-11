<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailController extends AbstractController
{

    #[Route('/email')]
    public function sendMail(MailerInterface $mailer)
    {
        $mail = (new TemplatedEmail())
            ->from('expediteur@demo.test')
            ->to('destinataire@demo.test')
            ->subject('Pari terminé')
            ->htmlTemplate('mail/template.html.twig');
     
        $mailer->send($mail);
    }
}