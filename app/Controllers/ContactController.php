<?php

namespace App\Controllers;

use Zend\Diactoros\ServerRequest;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use App\Models\Message;

class ContactController extends BaseController{
    public function index()
    {
        return $this->renderHTML('contacts/index.twig');
    }

    public function send(ServerRequest $request)
    {
        $data=$request->getParsedBody();

        $message = new Message();
        $message->name =$data['name'];
        $message->email =$data['email'];
        $message->message =$data['message'];
        $message->save();

        return $this->redirectHTML('../contact');   
    }
}