<?php

namespace Kendoctor\Bundle\AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Project
 *
 * @ORM\Table(name="scrum_agile_project")
 * @ORM\Entity
 */
class Project
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=128)
     *
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;


    /**
     * @var string
     *
     * @ORM\Column(name="support_email", type="string", length=128)
     *
     */
    protected $supportEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date")
     * @Gedmo\Timestampable(on="create")
     *
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="date")
     * @Gedmo\Timestampable(on="update")
     *
     */
    protected $updatedAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     *
     */
    protected $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $updatedBy;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSupportEmail()
    {
        return $this->supportEmail;
    }

    /**
     * @param string $supportEmail
     */
    public function setSupportEmail($supportEmail)
    {
        $this->supportEmail = $supportEmail;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param User $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param User $updatedBy
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }


//    protected $participantPermissionGroup;
//
//    protected $adminPermissionGroup;
//
//    //protected $
//    /**
//     * @var Collection
//     *
//     * @ORM|ManyToMany(targetEntity="User")
//     * @ORM\JoinTable(name="projects_participants")
//     *
//     */
//    protected $participants;
//
//    /**
//     * @var Collection
//     *
//     * @ORM\ManyToMany(targetEntity="User")
//     * @ORM\JoinTable(name="projects_admins")
//     *
//     */
//    protected $admins;
//
//    /**
//     * @var Collection
//     *
//     * @ORM\ManyToMany(targetEntity="User")
//     * @ORM\
//     */
//    protected $productOwners;
//
//    protected $scrumMasters;
//
//    protected $devTeamMembers;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

