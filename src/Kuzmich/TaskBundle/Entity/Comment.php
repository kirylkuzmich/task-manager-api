<?php

namespace Kuzmich\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="Kuzmich\TaskBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="comments", cascade={"persist"})
     */
    private $task;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=500)
     */
    private $comment;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }


    /**
     * @param Task|null $task
     * @return $this
     */
    public function setTask(\Kuzmich\TaskBundle\Entity\Task $task = null)
    {
        $this->task = $task;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }
}

