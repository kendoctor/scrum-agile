<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/10/26
 * Time: 下午3:10
 */

namespace Kendoctor\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Kendoctor\Bundle\AppBundle\Manager\UserManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface {

    protected $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->getManager()->createUser();
        $user->addRole('ROLE_ADMIN');
        $user->setUsername('kendoctor');
        $user->setEmail('kendoctor@163.com');
        $user->setPlainPassword('6158896');
        $user->setEnabled(true);

        $this->getManager()->updateUser($user);

        $this->setReference('kendoctor_user_admin', $user);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function get($id)
    {
        return $this->container->get($id);
    }

    /**
     * @return UserManager
     *
     */
    public function getManager()
    {
        return $this->get('kendoctor_app.entity.user_manager');
    }
}