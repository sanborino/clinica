<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\User;
use Asi\ClinicaBundle\Entity\Usuario;
use Asi\ClinicaBundle\Form\UsuarioType;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Security\Core\Role\RoleHierarchy;

/**
 * Usuario controller.
 *
 */
class UsuarioController extends Controller
{

    /**
     * Lists all Usuario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:User')->findAll();

        return $this->render('AsiClinicaBundle:Usuario:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Usuario entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setEnabled(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuario_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Usuario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Usuario entity.
     *
     * @param Usuario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new RegistrationFormType('Asi\ClinicaBundle\Entity\User'), $entity, array(
            'action' => $this->generateUrl('usuario_create'),
            'method' => 'POST',
        ));
        $form->remove('estadoActivacion');
        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Usuario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Usuario entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Usuario:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Usuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
    * Creates a form to edit a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new RegistrationFormType('Asi\ClinicaBundle\Entity\User'), $entity, array(
            'action' => $this->generateUrl('usuario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        $form->remove('plainPassword');
        return $form;
    }
    
    private function createAddRolesForm(User $user)
    {   
        $user_roles = $user->getRoles();

        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
            ->setAction($this->generateUrl('usuario_roles_add', array('id' => $user->getId())))
            ->setMethod('PUT')
            ->add('role', 'choice', 
                    array(
                        'choices' => $this->get('roles_provider')->getPossibleRoles(),
                        'data' => -1
                    )

                )
            ->add('role', 'choice', array(
                'choices' => $this->get('roles_provider')->getPossibleRoles(),
                'preferred_choices' => $this->get('roles_provider')->getUserIdRoles($user_roles)
            ))
            ->getForm();

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Usuario entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            //******************
            // Updating the ROLE            
            $fos_user_registration = $request->request->get('fos_user_registration');

            $roles_provider = $this->get('roles_provider');

            $new_role = $roles_provider->getRoleNameById($fos_user_registration['idTipoUsuario']);

            $roles_db = $roles_provider->getPossibleRoles();

            foreach ($roles_db as $role_db) {
                $entity->removeRole($role_db);
            }

            $entity->addRole($new_role);

            $this->get('fos_user.user_manager')->updateUser($entity);
            //******************


            $em->flush();

            return $this->redirect($this->generateUrl('usuario_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Usuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Usuario entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usuario'));
    }

    /**
     * Creates a form to delete a Usuario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }

    public function rolesAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AsiClinicaBundle:User')->find($id);

        $user = $em->getRepository('AsiClinicaBundle:User')->find($id);

        if (false === $this->get('security.context')->isGranted('view', $user)) {
            throw new AccessDeniedException('Unauthorised access!');
        }

        
        $roles = $this->get('roles_provider')->getPossibleRoles();

        $user_roles = $user->getRoles();

        $roles2add = array_diff($roles, $user_roles);

        return $this->render('AsiClinicaBundle:Usuario:roles.html.twig', array(
            'user_id' => $id,
            'roles' => $roles2add,
            'user_roles' => $user_roles
        ));
    }

    public function addRoleAction($id, $role){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AsiClinicaBundle:User')->find($id);

        $user->addRole($role);

        $this->get('fos_user.user_manager')->updateUser($user);

        return $this->redirect($this->generateUrl('usuario_roles', array('id' => $id)));
    }

    public function deleteRoleAction($id, $role){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AsiClinicaBundle:User')->find($id);

        $user->removeRole($role);

        $this->get('fos_user.user_manager')->updateUser($user);

        return $this->redirect($this->generateUrl('usuario_roles', array('id' => $id)));
    }
}
