<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category= new Category();
        $category2 = new Category();
        $category3 = new Category();
        $category->setCategory('winter');
        $category2->setCategory('landscape');
        $category3->setCategory('interior_design');
        $manager->persist($category);
        $manager->persist($category2);
        $manager->persist($category3);
        $this->addReference('category.winter',$category );
        $this->addReference('category.landscape',$category2 );
        $this->addReference('category.interior_design',$category3 );

        $manager->flush();
    }
    public function getOrder()
    {
        return 101;
    }
}
