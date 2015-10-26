<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/10/26
 * Time: 下午4:12
 */

namespace Kendoctor\Bundle\AppBundle\Controller\Admin;

use Kendoctor\Bundle\AppBundle\Form\UserProfileType;
use Kendoctor\Bundle\AppBundle\Form\UserResetPasswordType;
use Kendoctor\Bundle\AppBundle\Form\UserType;
use Kendoctor\Bundle\AppBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    /**
     * @return UserManager
     */
    protected function getManager()
    {
        return $this->get('kendoctor.manager.user');
    }

    public function indexAction(Request $request)
    {
        $criteria = array();

        $pagination = $this->getManager()
            ->createPagination(
                $criteria,
                $request->query->getInt('page', 1)
            );

        return $this->render('KendoctorAppBundle:Admin/User:index.html.twig', array(
            'pagination' => $pagination
        ));
    }

    protected function createCreateForm($entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('kendoctor_admin_user_create'),
            'method' => 'POST'
        ));

        return $form;
    }

    public function createAction(Request $request)
    {
        $entity = $this->getManager()->createUser();
        $form = $this->createCreateForm($entity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->update($entity);
            return $this->redirect($this->generateUrl('kendoctor_admin_user'));
        }

        return $this->render('KendoctorAppBundle:Admin/User:create.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    protected function createEditForm($entity)
    {
        $form = $this->createForm(new UserProfileType(), $entity, array(
            'action' => $this->generateUrl('kendoctor_admin_user_update', array(
                'id' => $entity->getId()
            )),
            'method' => 'PUT'
        ));

        return $form;
    }

    public function updateAction(Request $request, $id)
    {
        $entity = $this->getManager()
            ->getRepository()
            ->getById($id);

        if (null === $entity) {
            throw $this->createNotFoundException('User not found!');
        }

        $form = $this->createEditForm($entity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->update($entity);
            return $this->redirect($this->generateUrl('kendoctor_admin_user'));
        }

        return $this->render('KendoctorAppBundle:Admin/User:update.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

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

        return $this->redirect($this->generateUrl('kendoctor_admin_user'));
    }


    protected function createResetPasswordForm($entity)
    {
        $form = $this->createForm(new UserResetPasswordType(), $entity, array(
            'action' => $this->generateUrl('kendoctor_admin_user_reset_password', array(
                'id' => $entity->getId()
            )),
            'method' => 'PUT'
        ));

        return $form;
    }

    public function resetPasswordAction(Request $request, $id)
    {
        $entity = $this->getManager()
            ->getRepository()
            ->getById($id);

        if (null === $entity) {
            throw $this->createNotFoundException('User not found!');
        }

        $form = $this->createResetPasswordForm($entity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->update($entity);
            return $this->redirect($this->generateUrl('kendoctor_admin_user'));
        }

        return $this->render('KendoctorAppBundle:Admin/User:resetPassword.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

}