<?php
namespace App\Repository;

use App\Entity\SourceLanguage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SourceLanguage>
 */
class SourceLanguageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceLanguage::class);
    }

    /**
     * @param int $projectId
     * @return SourceLanguage[]
     */
    public function findBySource($source)
    {
        return $this->createQueryBuilder('sl')
            ->andWhere('sl.source = :source')
            ->setParameter('source', $source)
            ->getQuery()
            ->getResult();
    }
}
