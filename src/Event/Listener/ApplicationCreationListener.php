<?php
namespace App\Event\Listener;

use App\Email\ApplicationCreationMailer;
use App\Entity\Application;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class ApplicationCreationListener
{
    /**
     * @var ApplicationCreationMailer
     */
    private $applicationMailer;

    public function __construct(ApplicationCreationMailer $applicationMailer)
    {
        $this->applicationMailer = $applicationMailer;
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // We only want to send an email for Application entities
        if (!$entity instanceof Application) {
            return;
        }

        $this->applicationMailer->send($entity);
    }
}
