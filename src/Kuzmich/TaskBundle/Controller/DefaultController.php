<?php

namespace Kuzmich\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KuzmichTaskBundle:Default:index.html.twig');
    }
}
