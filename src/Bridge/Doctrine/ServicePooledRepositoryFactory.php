<?php

declare(strict_types=1);

namespace K911\Swoole\Bridge\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Repository\RepositoryFactory;
use Doctrine\Persistence\ObjectRepository;

final class ServicePooledRepositoryFactory implements RepositoryFactory
{
    private RepositoryFactory $decorated;

    private EntityManagerInterface $pooledEm;

    public function __construct(RepositoryFactory $decorated, EntityManagerInterface $pooledEm)
    {
        $this->decorated = $decorated;
        $this->pooledEm = $pooledEm;
    }

    public function getRepository(EntityManagerInterface $entityManager, $entityName): ObjectRepository
    {
        return $this->decorated->getRepository($this->pooledEm, $entityName);
    }
}
