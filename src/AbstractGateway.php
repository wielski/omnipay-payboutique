<?php

namespace Omnipay\Payboutique;

use Omnipay\Payboutique\Message\CompletePurchaseRequest;
use Omnipay\Payboutique\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway as OmnipayAbstractGateway;

/**
 * Class AbstractGateway
 * @package Omnipay\Payboutique
 */
abstract class AbstractGateway extends OmnipayAbstractGateway
{
    use ParametersTrait;

    /**
     * Create purchase
     * @param array $options
     * @return mixed
     */
    public function purchase(array $options = [])
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Complete purchase after notify
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function completePurchase(array $options = [])
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }
}