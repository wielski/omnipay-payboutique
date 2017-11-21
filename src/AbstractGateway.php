<?php

namespace Omnipay\Payboutique;

use Guzzle\Http\ClientInterface;
use Omnipay\Payboutique\Message\CompletePurchaseRequest;
use Omnipay\Payboutique\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway as OmnipayAbstractGateway;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractGateway
 * @package Omnipay\Payboutique
 */
abstract class AbstractGateway extends OmnipayAbstractGateway
{
    use ParametersTrait;

    /**
     * AbstractGateway constructor.
     * @param ClientInterface|null $httpClient
     * @param HttpRequest|null $httpRequest
     */
    public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null)
    {
        parent::__construct($httpClient, $httpRequest);
        $this->setTime(date('c'));
    }

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