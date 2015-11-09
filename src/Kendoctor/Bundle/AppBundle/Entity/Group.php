<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/11/1
 * Time: 上午6:39
 */

namespace Kendoctor\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\Group as BaseGroup;

/**
 * Group
 *
 * @ORM\Table(name = "scrum_agile_user_group")
 * @ORM\Entity(repositoryClass="Kendoctor\Bundle\AppBundle\Entity\GroupRepository")
 */
class Group extends BaseGroup
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
     * @ORM\ManyToMany(targetEntity="User",  mappedBy="groups")
     */
    protected $users;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct($name, $roles=array())
    {
        parent::__construct($name, $roles);
    }

    public function getUsers()
    {
        return $this->users ?: $this->users = new ArrayCollection();

    }

    public function hasUser(User $user)
    {
        return $user->hasGroup($this->getName());
    }

    public function addUser(User $user)
    {
        if (!$this->hasUser($user)) {
            $user->addGroup($this);
        }
        return $this;
    }

    public function removeUser(User $user)
    {
        if ($this->hasUser($user)) {
            $user->removeGroup($this);
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->getName();
    }
}