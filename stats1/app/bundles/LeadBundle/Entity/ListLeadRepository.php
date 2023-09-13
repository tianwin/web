<?php

namespace Mautic\LeadBundle\Entity;

use Mautic\CoreBundle\Entity\CommonRepository;

class ListLeadRepository extends CommonRepository
{
    /**
     * Updates lead ID (e.g. after a lead merge).
     *
     * @param $fromLeadId
     * @param $toLeadId
     */
    public function updateLead($fromLeadId, $toLeadId)
    {
        // First check to ensure the $toLead doesn't already exist
        $results = $this->_em->getConnection()->createQueryBuilder()
            ->select('l.leadlist_id')
            ->from(MAUTIC_TABLE_PREFIX.'lead_lists_leads', 'l')
            ->where('l.lead_id = '.$toLeadId)
            ->execute()
            ->fetchAll();
        $lists = [];
        foreach ($results as $r) {
            $lists[] = $r['leadlist_id'];
        }

        $q = $this->_em->getConnection()->createQueryBuilder();
        $q->update(MAUTIC_TABLE_PREFIX.'lead_lists_leads')
            ->set('lead_id', (int) $toLeadId)
            ->where('lead_id = '.(int) $fromLeadId);

        if (!empty($lists)) {
            $q->andWhere(
                $q->expr()->notIn('leadlist_id', $lists)
            )->execute();

            // Delete remaining leads as the new lead already belongs
            $this->_em->getConnection()->createQueryBuilder()
                ->delete(MAUTIC_TABLE_PREFIX.'lead_lists_leads')
                ->where('lead_id = '.(int) $fromLeadId)
                ->execute();
        } else {
            $q->execute();
        }
    }

    /**
     * @param mixed[] $filters
     */
    public function getContactsCountBySegment(int $segmentId, array $filters = []): int
    {
        $qb = $this->createQueryBuilder('ll');
        $qb->select('count(ll.list) as count')
            ->where('ll.list = :segmentId')
            ->setParameter('segmentId', $segmentId);

        if (!empty($filters)) {
            foreach ($filters as $colName => $val) {
                $entityFieldName = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $colName))));
                $qb->andWhere(sprintf('ll.%s=:%s', $entityFieldName, $entityFieldName));
                $qb->setParameter($entityFieldName, $val);
            }
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}
