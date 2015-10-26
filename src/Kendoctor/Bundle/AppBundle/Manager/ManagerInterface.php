<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/10/26
 * Time: 下午7:04
 */

namespace Kendoctor\Bundle\AppBundle\Manager;


use Doctrine\ORM\EntityRepository;
use Knp\Component\Pager\Paginator;

interface ManagerInterface {
    /**
     * 创建实体实例
     *
     * @return mixed
     */
    public function create();

    /**
     * @param $entity
     * @param bool $flush
     */
    public function update($entity, $flush = true);


    /**
     * @param $entity
     */
    public function remove($entity);

    /**
     *
     */
    public function flush();

    /**
     * @param $criteria
     * @param $page
     * @param int $limit
     * @return mixed
     */
    public function createPagination($criteria, $page, $limit = 10);

    /**
     * 获取实体类Repository
     *
     * @return EntityRepository
     */
    public function getRepository();

    /**
     * @return Paginator
     */
    public function getPaginator();

}