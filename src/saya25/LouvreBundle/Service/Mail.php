<?php


namespace saya25\LouvreBundle\Service;


use Symfony\Component\HttpFoundation\Session\Session;

class Mail {

    /**
     * @var Session
     */
    private $session;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    private $twig;

    public function __construct(Session $session, \Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->session = $session;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }



    public function sendMail()
    {
        $commande = $this->session->get('commande');

        if ($commande) {
            $message = \Swift_Message::newInstance()
                ->setCharset('UTF-8')
                ->setSubject('Votre réservation au musée du Louvre')
                ->setBody($this->twig->render('saya25LouvreBundle:Ticket:mail.html.twig'))
                ->setContentType('text/html')
                ->setFrom('museeLouvre@gmail.com')
                ->setTo($commande->getEmail());

            $this->mailer->send($message);
        }
    }
}