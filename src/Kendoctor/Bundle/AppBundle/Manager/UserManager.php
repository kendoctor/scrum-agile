<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/10/26
 * Time: 下午3:23
 */

namespace Kendoctor\Bundle\AppBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use FOS\UserBundle\Util\CanonicalizerInterface;
use Knp\Component\Pager\Paginator;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserManager extends BaseUserManager implements ManagerInterface
{

    /** @var  Paginator */
    protected $knpPaginator;


    public function __construct($p_kendoctor_app__entity__user_class,
                                EncoderFactoryInterface $s_security__encoder_factory,
                                CanonicalizerInterface $s_fos_user__util__username_canonicalizer,
                                CanonicalizerInterface $s_fos_user__util__email_canonicalizer,
                                ObjectManager $s_fos_user__entity_manager,
                                $s_knp_paginator)
    {
        parent::__construct($s_security__encoder_factory, $s_fos_user__util__username_canonicalizer, $s_fos_user__util__email_canonicalizer, $s_fos_user__entity_manager, $p_kendoctor_app__entity__user_class);
        $this->knpPaginator = $s_knp_paginator;
    }

    /**
     * 创建实体实例
     *
     * @return mixed
     */
    public function create()
    {
        return $this->createUser();
    }

    /**
     * @param $entity
     * @param bool $flush
     */
    public function update($entity, $flush = true)
    {
        $this->updateUser($entity, $flush);
    }

    /**
     * @param $entity
     */
    public function remove($entity)
    {
        $this->deleteUser($entity);
    }

    /**
     *
     */
    public function flush()
    {
        $this->objectManager->flush();
    }

    /**
     * @param $criteria
     * @param $page
     * @param int $limit
     * @return mixed
     */
    public function createPagination($criteria, $page, $limit = 10)
    {
        return $this->getPaginator()->paginate(
            $this->getRepository()->createIndexQueryBuilder($criteria),
            $page,
            $limit
        );
    }

    /**
     * 获取实体类Repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->objectManager->getRepository($this->class);
    }

    /**
     * @return Paginator
     */
    public function getPaginator()
    {
        return $this->knpPaginator;
    }
}