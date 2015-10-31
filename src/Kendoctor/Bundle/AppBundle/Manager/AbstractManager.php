<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/10/11
 * Time: 上午9:00
 */

namespace Gilido\Bundle\CoreBundle\Manager;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Kendoctor\Bundle\AppBundle\Manager\ManagerInterface;
use Knp\Component\Pager\Paginator;

abstract class AbstractManager implements ManagerInterface
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /** @var  string */
    protected $className;

    /** @var  Paginator */
    protected $knpPaginator;


    public function __construct($className, $entityManager, $knpPaginator)
    {
        $this->className = $className;
        $this->entityManager = $entityManager;
        $this->knpPaginator = $knpPaginator;
    }

    /**
     * 创建实体实例
     *
     * @return mixed
     */
    public function create()
    {
        return new $this->className;
    }

    /**
     * @param $entity
     * @param bool $flush
     */
    public function update($entity, $flush = true)
    {
        $this->entityManager->persist($entity);
        if ($flush)
            $this->entityManager->flush();
    }

    /**
     * @param $entity
     */
    public function remove($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function flush()
    {
        $this->entityManager->flush();
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
        return $this->entityManager->getRepository($this->className);
    }


    /**
     * @return Paginator
     */
    public function getPaginator()
    {
        return $this->knpPaginator;
    }

}