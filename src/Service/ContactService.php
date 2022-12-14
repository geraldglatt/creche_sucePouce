<?php

namespace App\Service;

use DateTimeImmutable;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


class ContactService
{
    private $em;
    private $flash;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function persistContact(Contact $contact): void
    {
        $contact->setIsSend(false)
                ->setCreatedAt(new DateTimeImmutable('now'));

        $this->em->persist($contact);
        $this->em->flush();
    }

    public function isSend(Contact $contact): void
    {
        $contact->setIsSend(true);

        $this->em->persist($contact);
        $this->em->flush();
    }

}