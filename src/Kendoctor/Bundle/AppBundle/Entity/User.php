<?php

namespace Kendoctor\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name = "scrum_agile_user")
 * @ORM\Entity(repositoryClass="Kendoctor\Bundle\AppBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Group",  inversedBy="users")
     * @ORM\JoinTable(name="users_groups")
     *
     */
    protected $groups;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    public function getBaseRoles()
    {
        return $this->roles;
    }

    public function setBaseRoles($roles)
    {
        $this->setRoles($roles);
    }

    public function __construct()
    {
        parent::__construct();
        $this->groups = new ArrayCollection();
    }
}

