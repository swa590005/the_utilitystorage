<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(5,'main_user',function ($i){
                $user= new User();
                $user->setEmail(sprintf('utility%d@example.com',$i));
                $user->setFirstName($this->faker->firstName);

                return $user;
        });
        $manager->flush();
    }
}
