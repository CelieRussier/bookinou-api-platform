<?php

namespace App\DataPersister;

use App\Entity\Story;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\b;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;


class StoryDataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
    ) {
        $this->_entityManager = $entityManager;
    }
    
    
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Story;
    }

    public function persist($data, array $context = [])
    {
        $data->setEan(
            $this->set_ean()
        );

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }

    /**
     * Set the value of _ean
     *
     * @return  self
     */ 
    public function set_ean()
    {
        $_ean = 97;
        $_ean .= rand(8, 9);
        for ($i=0; $i<10; $i++) {
            $_ean .= rand(0,9);
        };
        $this->_ean = $_ean;

        return $_ean;
    }
}