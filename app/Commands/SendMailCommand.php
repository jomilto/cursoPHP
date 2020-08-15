<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Models\Message;

class SendMailCommand extends Command{
    protected static $defaultName = 'app:send-mail';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pendingMessages = Message::where('sent',0)->get();
        foreach($pendingMessages as $message){
            $output->writeln('Mensaje enviado a ' . $message->email);
            // $transport = (new Swift_SmtpTransport($_ENV['SMTP_HOST'], $_ENV['SMTP_HOST']))
            //     ->setUsername($_ENV['SMTP_USER'])
            //     ->setPassword($_ENV['SMTP_PASSWORD']);

            // // Create the Mailer using your created Transport
            // $mailer = new Swift_Mailer($transport);

            // // Create a message
            // $message = (new Swift_Message('SomeBody Contact you'))
            // ->setFrom(['contact@mail.com' => 'Contact Form'])
            // ->setTo([$message->email, $message->email => $message->name])
            // ->setBody($message->message);

            // // Send the message
            // $result = $mailer->send($message);
            $message->sent = true;
            $message->save();
        }
        return Command::SUCCESS;
    }
}