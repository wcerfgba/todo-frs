<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;

class APIController extends FOSRestController
{
    /**
     * @Get("/", name="api_index")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:Task');
        $tasks = $repo->findAll();

        $view = $this->view($tasks, 200);

        return $this->handleView($view);
    }

    /**
     * @Post("/new", name="api_new")
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $view = $this->view($task, 200);

            return $this->handleView($view);
        }

        $view = $this->view($form, 400);

        return $this->handleView($view);
    }

    /**
     * @Delete("/{id}", name="api_delete", requirements={ "id": "\d+" })
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('AppBundle:Task')->find($id);

        if ($task === null)
        {
            $error = array( 'error' => "Task with id $id not found." );

            $view = $this->view($error, 404);

            return $this->handleView($view);
        }

        $em->remove($task);
        $em->flush();

        $view = $this->view($task, 200);

        return $this->handleView($view);
    }
}
