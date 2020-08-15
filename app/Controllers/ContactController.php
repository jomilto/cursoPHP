<?php

namespace App\Controllers;

use Zend\Diactoros\ServerRequest;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class ContactController extends BaseController{
    public function index()
    {
        return $this->renderHTML('contacts/index.twig');
    }

    public function send(ServerRequest $request)
    {
        $data=$request->getParsedBody();

        $transport = (new Swift_SmtpTransport($_ENV['SMTP_HOST'], $_ENV['SMTP_HOST']))
            ->setUsername($_ENV['SMTP_USER'])
            ->setPassword($_ENV['SMTP_PASSWORD']);

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('SomeBody Contact you'))
        ->setFrom(['contact@mail.com' => 'Contact Form'])
        ->setTo([$data['email'], $data['email'] => $data['name']])
        ->setBody($data['message']);

        // Send the message
        $result = $mailer->send($message);

        return $this->redirectHTML('contact');   
    }
}