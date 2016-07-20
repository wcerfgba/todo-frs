<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

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
    public function newAction()
    {
    }

    /**
     * @Delete("/{id}", name="api_delete", requirements={ "id": "\d+" })
     */
    public function deleteAction()
    {
    }
}
