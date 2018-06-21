<?php

namespace Kuzmich\TaskBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Kuzmich\TaskBundle\Entity\Comment;
use Kuzmich\TaskBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

/**
 * Task controller.
 *
 */
class TaskController extends FOSRestController
{
    /**
     * @return array|\Kuzmich\TaskBundle\Entity\Task[]
     */
    public function indexAction()
    {
        $tasks = $this->getDoctrine()->getRepository('KuzmichTaskBundle:Task')->findAll();

        return $tasks;
    }


    /**
     * @param Request $request
     * @return View
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $name = $request->get('name');
        $description = $request->get('description');
        $status = $request->get('status');
        $date = $request->get('date');

        $task->setName($name);
        $task->setDescription($description);
        $task->setStatus($status);
        $task->setDate($date);
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return new View("Task Added Successfully", Response::HTTP_OK);
    }


    /**
     * @param Request $request
     * @return Task
     */
    public function showAction(Request $request)
    {
        $id = $request->get('id');
        $task = $this->getDoctrine()->getRepository('KuzmichTaskBundle:Task')->find($id);

        return $task;
    }


    /**
     * @param $id
     * @param Request $request
     * @return View
     */
    public function editAction($id, Request $request)
    {
        $sn = $this->getDoctrine()->getManager();
        $task = $this->getDoctrine()->getRepository('KuzmichTaskBundle:Task')->find($id);
        $comment =new Comment();
        $status = $request->get('status');
        $task->setStatus($status);
        $requestComment = $request->get('comment');

        if(!empty($requestComment))
        {
            $comment->setComment($requestComment);
            $comment->setTask($task);
            $task->addComment($comment);
        }

        $sn->flush();

        return new View("Task Updated Successfully", Response::HTTP_OK);
    }

}
