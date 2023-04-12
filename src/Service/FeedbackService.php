<?php

namespace App\Service;

use App\Entity\Feedback;
use App\Repository\FeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;

class FeedbackService
{
    private EntityManagerInterface $em;
    private FeedbackRepository $feedbackRepository;

    public function __construct(EntityManagerInterface $em, FeedbackRepository $feedbackRepository)
    {
        $this->em = $em;
        $this->feedbackRepository = $feedbackRepository;
    }

    public function addFeedback($feedbackData, $product)
    {
        /** @var Feedback $feedbackData */
        $feedback = new Feedback();
        $feedback->setProduct($product)
            ->setName($feedbackData->getName())
            ->setBody($feedbackData->getBody())
            ->setEmail($feedbackData->getEmail())
            ->setCreatedAt(new \DateTime("now"))
            ->setUpdatedAt(new \DateTime("now"))
        ;

        $this->em->persist($feedback);
        $this->em->flush();
    }

    public function getProductFeedback($productId)
    {
        return $this->feedbackRepository->findByProductId($productId);
    }

    public function getCount($productId)
    {
        $feedback = $this->feedbackRepository->findByProductId($productId);

        return count($feedback);
    }
}