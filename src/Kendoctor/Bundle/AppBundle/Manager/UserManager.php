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
use FOS\UserBundle\Util\CanonicalizerInterface;
use Knd\Bundle\RadBundle\Manager\Manager;
use Knp\Component\Pager\Paginator;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserManager extends Manager
{



    public function __construct($p_kendoctor_app__class__entity__user,
                                $s_service_container
    )
    {
        parent::__construct(
            $p_kendoctor_app__class__entity__user,
            $s_service_container
        );
    }

}