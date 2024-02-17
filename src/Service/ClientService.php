<?php

namespace App\Service;


class ClientService
{
    public function updateProfile($form, $user, $em)
    {
        $user->setName($form->get('name')->getData());
        $user->setCorporateName($form->get('corporate_name')->getData());
        $user->setSiret($form->get('siret')->getData());
        $user->setPhone($form->get('phone')->getData());
        $user->setAddress($form->get('address')->getData());
        $user->setCity($form->get('city')->getData());
        $user->setZip($form->get('zip')->getData());
        $user->setCountry($form->get('country')->getData());

        $em->persist($user);
        $em->flush();
    }
}