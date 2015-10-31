<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/10/26
 * Time: 下午4:12
 */

namespace Kendoctor\Bundle\AppBundle\Controller\Admin;

use Kendoctor\Bundle\AppBundle\Manager\UserManager;
use Knp\RadBundle\Controller\Controller;
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
        return $this->get('kendoctor.manager.user');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $criteria = array();

        $pagination = $this->getManager()
            ->createPagination(
                $criteria,
                $request->query->getInt('page', 1)
            );

        return ['pagination' => $pagination];

    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $entity = $this->getManager()->createUser();
        $form = $this->createBoundObjectForm($entity, null, array(
            'action' => $this->generateUrl('kendoctor_admin_user_create')
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->update($entity);
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
        $entity = $this->getManager()
            ->getRepository()
            ->getById($id);

        if (null === $entity) {
            throw $this->createNotFoundException('User not found!');
        }

        $form = $this->createBoundObjectForm($entity, 'profile', array(
            'method' => 'PUT',
            'action' => $this->generateUrl('kendoctor_admin_user_update', array('id' => $entity->getId()))
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->update($entity);
            return $this->redirect($this->generateUrl('kendoctor_admin_user_index'));
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
        $entity = $this->getManager()
            ->getRepository()
            ->getById($id);

        if (null === $entity) {
            throw $this->createNotFoundException('User not found!');
        }

        if ($this->getUser() === $entity) {
            $this->addFlash('notice', 'Current login user can not be deleted');
        }
        else
        {
            $this->getManager()->remove($entity);
            $this->addFlash('notice', sprintf('User %s deleted.', $entity->getUsername()));
        }

        return $this->redirect($this->generateUrl('kendoctor_admin_user_index'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function resetPasswordAction(Request $request, $id)
    {
        $entity = $this->getManager()
            ->getRepository()
            ->getById($id);

        if (null === $entity) {
            throw $this->createNotFoundException('User not found!');
        }

        $form = $this->createBoundObjectForm($entity, 'resetPassword', array(
            'method' => 'PUT',
            'action' => $this->generateUrl('kendoctor_admin_user_reset_password', array('id' => $entity->getId()))
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->update($entity);
            return $this->redirect($this->generateUrl('kendoctor_admin_user_index'));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

}