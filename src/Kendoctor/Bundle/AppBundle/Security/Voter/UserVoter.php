<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/11/9
 * Time: 下午12:10
 */

namespace Kendoctor\Bundle\AppBundle\Security\Voter;

use Knd\Bundle\RadBundle\DependencyInjection\AutoInjectInterface;
use Knd\Bundle\RadBundle\Security\Voter\Voter;

class UserVoter extends Voter implements AutoInjectInterface {

    public function getSupportedRoles()
    {
        $roles = parent::getSupportedRoles();

        return array_merge($roles, array(
            $this->newRole('reset_password'),
            $this->newRole('reset_password', 'owner')
        ));
    }

    public static function getConstructorParameters()
    {
        return array(
            '%kendoctor_app.class.entity.user%'
        );
    }
}