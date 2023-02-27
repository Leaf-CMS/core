<?php

namespace Leaf\Core\src\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Leaf\Core\src\Model\LeafPage;

class PageRepository implements ServiceEntityRepositoryInterface
{
    public function __construct(private ManagerRegistry $managerRegistry)
    {
        $this->manager = $this->managerRegistry->getManager(LeafPage::class);
        $this->repository = $this->managerRegistry->getRepository(LeafPage::class);
    }

    public function all(): array {
        return $this->repository->findAll();
    }
}