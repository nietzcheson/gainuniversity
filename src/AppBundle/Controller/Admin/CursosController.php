<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Admin\Cursos\Cursos;
use AppBundle\Entity\Admin\Cursos\CursoUsuarios;
use AppBundle\Form\Admin\Cursos\CursosType;
use AppBundle\Form\Admin\Cursos\ModulosCursoType;
use AppBundle\Form\Admin\Cursos\CursoModulosType;

use AppBundle\Form\Admin\Cursos\AddModulosCursoType;

use AppBundle\Form\Admin\Cursos\UsuariosCursoType;
use AppBundle\Form\Admin\Cursos\AddUsuariosType;
use Doctrine\Common\Collections\ArrayCollection;

use AppBundle\Entity\Admin\Cursos\CursoModulos;



/**
 * Cursos controller.
 *
 */
class CursosController extends Controller
{

    /**
     * Lists all Cursos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Admin\Cursos\Cursos')->findAll();

        return $this->render('Admin/Cursos/index.html.twig', array(
            'entities' => $entities,
        ));
    }


    /**
     * Displays a form to create a new Cursos entity.
     *
     */
    public function newAction(Request $request)
    {
      $curso = new Cursos();
      $cursoForm = $this->createForm(new CursosType(), $curso);
      $cursoForm->handleRequest($request);

      if ($cursoForm->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($curso);
          $em->flush();

          return $this->redirect($this->generateUrl('admin_cursos_edit', array('id' => $curso->getId())));
      }

      return $this->render('Admin/Cursos/new.html.twig', array(
          'curso' => $curso,
          'curs_form'   => $cursoForm->createView(),
      ));
    }

    /**
     * Finds and displays a Cursos entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElearnBundle:Cursos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cursos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ElearnBundle:Cursos:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cursos entity.
     *
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $curso = $em->getRepository('AppBundle:Admin\Cursos\Cursos')->find($id);

        $originalModulos = new ArrayCollection();

        foreach($curso->getModulos() as $modulo){
          $originalModulos->add($modulo);
        }

        if (!$curso) {
            throw $this->createNotFoundException('Unable to find Cursos entity.');
        }

        $cursoForm = $this->createForm(new CursosType(), $curso);

        $cursoForm->handleRequest($request);
        $deleteForm = $this->createDeleteForm($id);

        if ($cursoForm->isValid()) {

            $em->flush();

            $this->get('app.mensajero')->add('info','Se han actualizado los datos del Curso');

            return $this->redirect($this->generateUrl('admin_cursos_edit', array('id' => $curso->getId())));
        }


        $cursoModulos = new CursoModulos();

        $cursoModulosForm = $this->createForm(new AddModulosCursoType(), $cursoModulos);

        $cursoModulosForm->handleRequest($request);

        if($cursoModulosForm->isValid()){

          $cursoModulos->setPosicion(count($originalModulos) + 1);
          $cursoModulos->setCursos($curso);

          $em->persist($cursoModulos);
          $em->flush();
          $this->get('app.mensajero')->add('info','Se ha agregado un Módulo al Curso');

          return $this->redirect($this->generateUrl('admin_cursos_edit', array('id' => $curso->getId())));

        }

        $modulosCursoForm = $this->createForm(new ModulosCursoType(), $curso);
        $modulosCursoForm->handleRequest($request);

        if($modulosCursoForm->isValid()){

            foreach($originalModulos as $o){
              if(false === $curso->getModulos()->contains($o)){
                $em->remove($o);
              }
            }

            $em->flush();

            $this->get('app.mensajero')->add('info','Los Módulos se han actualizado');

            return $this->redirect($this->generateUrl('admin_cursos_edit', array('id' => $curso->getId())));
        }

        $cursoUsuarios = new CursoUsuarios();

        $addUsuariosForm = $this->createForm(new AddUsuariosType(), $cursoUsuarios);
        $addUsuariosForm->handleRequest($request);

        if($addUsuariosForm->isValid()){

            $cursoUsuarios->setCursos($curso);
            $em->persist($cursoUsuarios);
            $em->flush();

            $this->get('app.mensajero')->add('info','Se ha agregado un nuevo Usuario');
            return $this->redirect($this->generateUrl('admin_cursos_edit', array('id' => $curso->getId())));

        }

        $usuariosCursoForm = $this->createForm(new UsuariosCursoType(), $curso);

        return $this->render('Admin/Cursos/edit.html.twig', array(
            'curso'      => $curso,
            'curso_form'   => $cursoForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'modulos_curso_form' => $modulosCursoForm->createView(),
            'add_modulos_form' => $cursoModulosForm->createView(),
            'add_usuarios_form' => $addUsuariosForm->createView(),
            'usuarios_curso_form' => $usuariosCursoForm->createView()
        ));
    }

    /**
    * Creates a form to edit a Cursos entity.
    *
    * @param Cursos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cursos $entity)
    {
        $form = $this->createForm(new CursosType(), $entity, array(
            'action' => "",
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Cursos entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElearnBundle:Cursos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cursos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cursos_edit', array('id' => $id)));
        }

        return $this->render('ElearnBundle:Cursos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cursos entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ElearnBundle:Cursos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cursos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_cursos'));
    }

    /**
     * Creates a form to delete a Cursos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_cursos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }

    public function eliminarUsuariosCursoAction($curso, $id)
    {
      $em = $this->getDoctrine()->getManager();
      $cursoUsuario = $em->getRepository('AppBundle:Admin\Cursos\CursoUsuarios')->find($id);

      $em->remove($cursoUsuario);
      $em->flush();

      $this->get('app.mensajero')->add('info','Se ha eliminado un Usuario del Curso');
      return $this->redirect($this->generateUrl('admin_cursos_edit', array('id' => $curso)));

    }
}
