<?php

namespace Mautic\LeadBundle\Controller;

use Mautic\CoreBundle\Factory\PageHelperFactoryInterface;
use Mautic\LeadBundle\Entity\LeadRepository;

trait EntityContactsTrait
{
    /**
     * @param string|int              $entityId
     * @param int                     $page
     * @param string                  $permission
     * @param string                  $sessionVar
     * @param string                  $entityJoinTable    Table to join to obtain list of related contacts or a DBAL QueryBuilder object defining custom joins
     * @param string|null             $dncChannel         Channel for this entity to get do not contact records for
     * @param string|null             $entityIdColumnName If the entity ID in $joinTable is not "id", set the column name here
     * @param array|null              $contactFilter      Array of additional filters for the getEntityContactsWithFields() function
     * @param array|null              $additionalJoins    [ ['type' => 'join|leftJoin', 'from_alias' => '', 'table' => '', 'condition' => ''], ... ]
     * @param string|null             $contactColumnName  Column of the contact in the join table
     * @param array|null              $routeParameters
     * @param string|null             $paginationTarget   DOM selector for injecting new content when pagination is used
     * @param string|null             $orderBy            optional OrderBy column, to be used to increase performance with joins
     * @param string|null             $orderByDir         optional $orderBy direction, to be used to increase performance with joins
     * @param int|null                $count              optional $count if already known to avoid an extra query
     * @param \DateTimeInterface|null $dateFrom           optionally limit to leads added between From and To dates
     * @param \DateTimeInterface|null $dateTo             optionally limit to leads added between From and To dates
     *
     * @return mixed
     */
    protected function generateContactsGrid(
        $entityId,
        $page,
        $permission,
        $sessionVar,
        $entityJoinTable,
        $dncChannel = null,
        $entityIdColumnName = 'id',
        array $contactFilter = null,
        array $additionalJoins = null,
        $contactColumnName = null,
        array $routeParameters = [],
        $paginationTarget = null,
        $orderBy = null,
        $orderByDir = null,
        $count = null,
        \DateTimeInterface $dateFrom = null,
        \DateTimeInterface $dateTo = null
    ) {
        if ($permission && !$this->get('mautic.security')->isGranted($permission)) {
            return $this->accessDenied();
        }

        // Set the route if not standardized
        $route = "mautic_{$sessionVar}_contacts";
        if (method_exists($this, 'getRouteBase') && $this->getRouteBase()) {
            $route = 'mautic_'.$this->getRouteBase().'_contacts';
        }

        // Apply filters
        if ('POST' == $this->request->getMethod()) {
            $this->setListFilters($sessionVar.'.contact');
        }

        $search = $this->request->get('search', $this->get('session')->get('mautic.'.$sessionVar.'.contact.filter', ''));
        $this->get('session')->set('mautic.'.$sessionVar.'.contact.filter', $search);

        /** @var PageHelperFactoryInterface $pageHelperFacotry */
        $pageHelperFacotry = $this->get('mautic.page.helper.factory');
        $pageHelper        = $pageHelperFacotry->make("mautic.{$sessionVar}", $page);

        $filter     = ['string' => $search, 'force' => []];
        $orderBy    = $orderBy ?: $this->get('session')->get('mautic.'.$sessionVar.'.contact.orderby', 'l.id');
        $orderByDir = $orderByDir ?: $this->get('session')->get('mautic.'.$sessionVar.'.contact.orderbydir', 'DESC');

        //set limits
        $limit = $this->get('session')->get(
            'mautic.'.$sessionVar.'.contact.limit',
            $this->get('mautic.helper.core_parameters')->get('default_pagelimit')
        );

        $start = (1 === $page) ? 0 : (($page - 1) * $limit);
        if ($start < 0) {
            $start = 0;
        }

        /** @var LeadRepository $repo */
        $repo     = $this->getModel('lead')->getRepository();
        $contacts = $repo->getEntityContacts(
            [
                'withTotalCount' => (null === $count),
                'start'          => $start,
                'limit'          => $limit,
                'filter'         => $filter,
                'orderBy'        => $orderBy,
                'orderByDir'     => $orderByDir,
                'select'         => ListController::SEGMENT_CONTACT_FIELDS,
                'route'          => $route,
            ],
            $entityJoinTable,
            $entityId,
            $contactFilter,
            $entityIdColumnName,
            $additionalJoins,
            $contactColumnName,
            $dateFrom,
            $dateTo
        );

        // Normalize results regarding withTotalCount.
        if (isset($contacts['count'])) {
            $count = (int) $contacts['count'];
        } else {
            $contacts = [
                'results' => $contacts,
                'count'   => $count,
            ];
        }

        if ($count && $count < ($start + 1)) {
            //the number of entities are now less then the current page so redirect to the last page
            $lastPage = $pageHelper->countPage($count);
            $pageHelper->rememberPage($lastPage);
            $returnUrl = $this->generateUrl($route, array_merge(['objectId' => $entityId, 'page' => $lastPage], $routeParameters));

            return $this->postActionRedirect(
                [
                    'returnUrl'         => $returnUrl,
                    'viewParameters'    => ['page' => $lastPage, 'objectId' => $entityId],
                    'contentTemplate'   => 'MauticLeadBundle:Lead:grid.html.php',
                    'forwardController' => false,
                    'passthroughVars'   => [
                        'mauticContent' => $sessionVar.'Contacts',
                    ],
                ]
            );
        }

        $pageHelper->rememberPage($page);

        // Get DNC for the contact
        $dnc = [];
        if ($dncChannel && $count > 0) {
            $dnc = $this->getDoctrine()->getManager()->getRepository('MauticLeadBundle:DoNotContact')->getChannelList(
                $dncChannel,
                array_keys($contacts['results'])
            );
        }

        return $this->delegateView(
            [
                'viewParameters' => [
                    'page'            => $page,
                    'items'           => $contacts['results'],
                    'totalItems'      => $contacts['count'],
                    'tmpl'            => $sessionVar.'Contacts',
                    'indexMode'       => 'grid',
                    'route'           => $route,
                    'routeParameters' => $routeParameters,
                    'sessionVar'      => $sessionVar.'.contact',
                    'limit'           => $limit,
                    'objectId'        => $entityId,
                    'noContactList'   => $dnc,
                    'target'          => $paginationTarget,
                ],
                'contentTemplate' => 'MauticLeadBundle:Lead:grid.html.php',
                'passthroughVars' => [
                    'mauticContent' => $sessionVar.'Contacts',
                    'route'         => false,
                ],
            ]
        );
    }
}
