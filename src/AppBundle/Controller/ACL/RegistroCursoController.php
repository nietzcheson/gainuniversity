<?php

namespace AppBundle\Controller\ACL;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use AppBundle\Entity\Admin\Cursos\CursoUsuarios;

class RegistroCursoController extends Controller
{
  public function registroCursoAction($id, $sku)
  {
    $em = $this->getDoctrine()->getManager();

    //Averiguamos el curso con el Salt enviado desde el correo del cliente
    $curso = $em->getRepository('AppBundle:Admin\Cursos\Cursos')->findOneBySku($sku);

    if (!$curso) {
        //throw $this->createNotFoundException('Este curso no existe.');
        throw new NotFoundHttpException('Este curso no existe');
    }

    // Conexión con el Servicio
    $cliente = new \nusoap_client($this->container->getParameter('wsdl'));

    // Pasamos los datos al Servicio
    $orden = array(
      'orderId' => $id,
      'sku' => $curso->getSku()
    );

    $conexion = $cliente->call("OrderStatSrv.getStat", $orden);

    // Si el valor de status es igual a 0 se puede registrar el usuario-curso

    //$conexion["status"] = 0;

    if ($conexion["status"] == 1) {
        //throw $this->createNotFoundException('Este curso no existe.');
        throw new NotFoundHttpException('El registro ya fue hecho');
    }

    if($conexion["status"] == 0){
      $user = $this->getUser();

      /**
       * Se consulta si el usuario tiene relación con el curso
       */

      $cursosUsuarios = $em->getRepository('AppBundle:Admin\Cursos\CursoUsuarios')->findCursosUsuarios($curso->getId(), $user->getId());

      // Si la consulta no existe se genera el registro
      if(!$cursosUsuarios){

        $cursoUsuario = new CursoUsuarios();

        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository('AppBundle:ACL\Usuarios')->find($user->getId());

        $cursoUsuario->setCurso($curso);
        $cursoUsuario->setUsuario($usuario);

        $em->persist($cursoUsuario);
        $em->flush();

        $usuario = $em->getRepository("AppBundle:ACL\Usuarios")->find($this->getUser()->getId());

        return $this->render('Front/tus-cursos.html.twig', array(
          'usuario' => $usuario,
          'mensaje' => 'El registro al curso se ha hecho.'
        ));
      }

      return $this->redirect($this->generateUrl('perfil_tus_cursos'));

    }

    return $this->redirect($this->generateUrl('perfil_tus_cursos'));

  }
}
