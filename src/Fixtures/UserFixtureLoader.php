<?php

namespace Simonetti\Fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Simonetti\Models\User;

class UserFixtureLoader implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNome('jwage');
        $user->setEmail('test');

        $manager->persist($user);
        $manager->flush();
    }
}