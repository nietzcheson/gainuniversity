<?php

namespace AppBundle\Controller\ACL;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use AppBundle\Entity\ACL\Usuarios;
use AppBundle\Form\ACL\RegistroUsuariosType;

class RegistroCuentaController extends Controller
{
  public function registroAction(Request $request)
  {
    $entity = new Usuarios();

    $registroForm = $this->createForm(new RegistroUsuariosType(), $entity);

    $registroForm->handleRequest($request);

    if($registroForm->isValid()){

      $formData = $registroForm->getData();

      $em = $this->getDoctrine()->getManager();

      $role = $em->getRepository("AppBundle:ACL\Roles")->find(2);

      $factory = $this->get('security.encoder_factory');
      $encoder = $factory->getEncoder($entity);
      $formData = $registroForm->getData();
      $entity->setPassword($encoder->encodePassword($formData->getPassword(), $entity->getSalt()));

      $entity->setRoles($role);
      $entity->setUsername($formData->getEmail());
      $entity->setIsActive(0);
      $entity->setActivado(0);
      $em->persist($entity);
      $em->flush();

      $message = \Swift_Message::newInstance()
        ->setContentType("text/html")
        ->setSubject('Activar su cuenta')
        ->setFrom(array("no-reply@gainuniversity.com" => "gainuniversity.com"))
        ->setTo($entity->getEmail())
        ->setBody($this->renderView(
          "ACL/mail-registro.html.twig", array(
            'entity' => $entity
          ))
        );

      $this->get('mailer')->send($message);
      
      return $this->render('ACL/mensaje-registro.html.twig', array(
         'usuario' => $formData->getNombre(),
         'email'   => $formData->getEmail()
      ));
    }

    return $this->render('ACL/registro.html.twig', array(
      'registro_form' => $registroForm->createView()
    ));
  }

  public function activarCuentaAction($salt)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('AppBundle:ACL\Usuarios')->findOneBySalt($salt);

    if (!$entity) {
        throw $this->createNotFoundException('Unable to find Usuarios entity.');
    }

    if($entity->getActivado()==0){
      $entity->setIsActive(1);
      $entity->setActivado(1);
      $em->flush();
      return $this->render('ACL/cuenta-activada.html.twig');
    }

    return $this->redirect($this->generateUrl('login'));
  }
}
