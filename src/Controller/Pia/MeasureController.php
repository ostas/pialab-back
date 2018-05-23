<?php

/*
 * Copyright (C) 2015-2018 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PiaApi\Controller\Pia;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use PiaApi\Entity\Pia\Measure;

class MeasureController extends PiaSubController
{

    /**
     * @FOSRest\Get("/pias/{piaId}/measures")
     * @Security("is_granted('ROLE_MEASURE_LIST')")
     */
    public function listAction(Request $request, $piaId)
    {
        return parent::listAction($request, $piaId);
    }

    /**
     * @FOSRest\Get("/pias/{piaId}/measures/{id}")
     * @Security("is_granted('ROLE_MEASURE_VIEW')")
     */
    public function showAction(Request $request, $piaId, $id)
    {
        return parent::showAction($request, $piaId, $id);
    }

    /**
     * @FOSRest\Post("/pias/{piaId}/measures")
     * @Security("is_granted('ROLE_MEASURE_CREATE')")
     */
    public function createAction(Request $request, $piaId)
    {
        return parent::createAction($request, $piaId);
    }

    /**
     * @FOSRest\Put("/pias/{piaId}/measures/{id}")
     * @FOSRest\Patch("/pias/{piaId}/measures/{id}")
     * @FOSRest\Post("/pias/{piaId}/measures/{id}")
     * @Security("is_granted('ROLE_MEASURE_EDIT')")
     */
    public function updateAction(Request $request, $piaId, $id)
    {
        return parent::updateAction($request, $piaId, $id);
    }

    /**
     * @FOSRest\Delete("pias/{piaId}/measures/{id}")
     * @Security("is_granted('ROLE_MEASURE_DELETE')")
     *
     * @return array
     */
    public function deleteAction(Request $request, $piaId, $id)
    {
        return parent::deleteAction($request, $piaId, $id);
    }

    protected function getEntityClass()
    {
        return Measure::class;
    }
}