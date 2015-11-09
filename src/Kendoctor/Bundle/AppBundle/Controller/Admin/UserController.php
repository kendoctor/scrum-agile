<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/10/26
 * Time: 下午4:12
 */

namespace Kendoctor\Bundle\AppBundle\Controller\Admin;

use Kendoctor\Bundle\AppBundle\Manager\UserManager;
use Knd\Bundle\RadBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package Kendoctor\Bundle\AppBundle\Controller\Admin
 */
class UserController extends Controller {

    /**
     * @return UserManager
     */
    protected function getManager()
    {
        return $this->get('kendoctor_app.manager.user');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $this->isGrantedOr403('kendoctor_app_entity_user.index', $this->getManager()->getClass());

        $criteria = array();

        $pagination = $this->getManager()
            ->createPagination(
                $criteria,
                $request->query->getInt('page', 1),
                20
            );

        return ['pagination' => $pagination];

    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $this->isGrantedOr403('kendoctor_app_entity_user.new', $this->getManager()->getClass());

        $entity = $this->getManager()->create();

        $form = $this->createBoundObjectForm($entity, null, array(
            'action' => $this->generateUrl('kendoctor_admin_user_create')
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->persist($entity, true);
            return $this->redirectToRoute('kendoctor_admin_user_index');
        }

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        $this->isGrantedOr403('kendoctor_app_entity_user.edit', $this->getManager()->getClass());

        $entity = $this->getManager()
            ->findOr404($id);
        //print_r($this->getUser()->getRoles());


        $form = $this->createBoundObjectForm($entity, 'profile', array(
            'method' => 'PUT',
            'action' => $this->generateUrl('kendoctor_admin_user_update', array('id' => $entity->getId()))
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->persist($entity, true);
            return $this->redirectToRoute('kendoctor_admin_user_index');
        }

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $this->isGrantedOr403('kendoctor_app_entity_user.delete', $this->getManager()->getClass());

        $entity = $this->getManager()
            ->findOr404($id);


        if ($this->getUser() === $entity) {
            $this->addFlash('notice', 'Current login user can not be deleted');
        }
        else
        {
            $this->getManager()->remove($entity, true);
            $this->addFlash('notice', sprintf('User %s deleted.', $entity->getUsername()));
        }

        return $this->redirectToRoute('kendoctor_admin_user_index');
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function resetPasswordAction(Request $request, $id)
    {

        $entity = $this->getManager()
            ->findOr404($id);

        $this->isGrantedOr403('kendoctor_app_entity_user.reset_password', $entity);

        $form = $this->createBoundObjectForm($entity, 'reset_password', array(
            'method' => 'PUT',
            'action' => $this->generateUrl('kendoctor_admin_user_reset_password', array('id' => $entity->getId()))
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->persist($entity, true);
            return $this->redirectToRoute('kendoctor_admin_user_index');
        }

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

}