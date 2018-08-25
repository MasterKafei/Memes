<?php

namespace AppBundle\Service\Business;

use AppBundle\Service\Util\AbstractContainerAware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RequestBusiness extends AbstractContainerAware
{
    /**
     * Get masterRequest.
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getMasterRequest()
    {
        return $this->container->get('request_stack')->getMasterRequest();
    }

    public function isAjaxRequest()
    {
        return $this->getMasterRequest()->isXmlHttpRequest();
    }

    public function allowAjaxRequestOnly()
    {
        if(!$this->isAjaxRequest()) {
            throw new NotFoundHttpException();
        }
    }
}
