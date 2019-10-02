<?php


namespace Model;


use Entity\Contact;
use http\Exception\RuntimeException;
use OpenFram\Manager;

class ContactManager extends Manager
{

    public function save(Contact $contact)
    {
        if ($contact->isValid()) {

            $this->sendMessage($contact);

        } else {
            throw new RuntimeException('Le message doit être valide pour être envoyé');
        }
    }

    public function sendMessage(Contact $contact)
    {
        $to      = 'tiguercha.djillali@gmail.com';
        $subject = $contact->getObject();
        $message = $contact->getMessage();
        $headers = 'From:' . $contact->getEmail() . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Emailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }


}