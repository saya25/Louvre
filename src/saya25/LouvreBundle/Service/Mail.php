<?php


namespace saya25\LouvreBundle\Service;


class Mail {


    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }



    public function sendMail()
    {
        $message = \Swift_Message::newInstance()
            ->setCharset('UTF-8')
            ->setSubject('Votre réservation au musée du Louvre')
            ->setBody($this->twig->render('saya25LouvreBundle:Ticket:accueil.html.twig'))
            ->setContentType('text/html')
            ->setFrom('museeLouvre@gmail.com')
            ->setTo('saya25@live.fr');

            $this->mailer->send($message);

    }
}