<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/11/1
 * Time: 上午7:00
 */

namespace Kendoctor\Bundle\AppBundle\Manager;


use Knd\Bundle\RadBundle\Manager\Manager;

class GroupManager extends Manager {

    public function __construct($p_kendoctor_app__class__entity__group,
                                $s_service_container
    )
    {
        parent::__construct(
            $p_kendoctor_app__class__entity__group,
            $s_service_container
            );
    }

    public function create($name = null)
    {
        return new $this->class($name);
    }
}