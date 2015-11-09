<?php
/**
 * Created by PhpStorm.
 * Group: kendoctor
 * Date: 15/10/26
 * Time: 下午4:12
 */

namespace Kendoctor\Bundle\AppBundle\Controller\Admin;

use Kendoctor\Bundle\AppBundle\Manager\GroupManager;
use Knd\Bundle\RadBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GroupController
 * @package Kendoctor\Bundle\AppBundle\Controller\Admin
 */
class GroupController extends Controller {

    /**
     * @return GroupManager
     */
    protected function getManager()
    {
        return $this->get('kendoctor_app.manager.group');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $this->isGrantedOr403('kendoctor_app_entity_group.index', $this->getManager()->getClass());

        $criteria = array();

        $pagination = $this->getManager()
            ->createPagination(
                $criteria,
                $request->query->getInt('page', 1),
                10
            );

        return $this->render('KendoctorAppBundle:Admin/Group:index.html.twig', array(
            'pagination' => $pagination
        ));

    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $this->isGrantedOr403('kendoctor_app_entity_group.new', $this->getManager()->getClass());

        $entity = $this->getManager()->create();

        $form = $this->createBoundObjectForm($entity, null, array(
            'action' => $this->generateUrl('kendoctor_admin_group_create')
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->persist($entity, true);
            return $this->redirectToRoute('kendoctor_admin_group_index');
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
        $this->isGrantedOr403('kendoctor_app_entity_group.edit', $this->getManager()->getClass());

        $entity = $this->getManager()->findOr404($id);

        $form = $this->createBoundObjectForm($entity, null, array(
            'method' => 'PUT',
            'action' => $this->generateUrl('kendoctor_admin_group_update', array('id' => $entity->getId()))
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager()->persist($entity, true);
            return $this->redirectToRoute('kendoctor_admin_group_index');
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
        $this->isGrantedOr403('kendoctor_app_entity_group.delete', $this->getManager()->getClass());

        $entity = $this->getManager()
            ->findOr404($id);


        $this->getManager()->remove($entity, true);
        $this->addFlash('notice', sprintf('Group %s deleted.', $entity->getName()));

        return $this->redirectToRoute('kendoctor_admin_group_index');
    }



}