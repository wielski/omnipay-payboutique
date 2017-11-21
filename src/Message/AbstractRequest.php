<?php

namespace Omnipay\Payboutique\Message;

use FluidXml\FluidXml;
use Guzzle\Http\ClientInterface;
use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Omnipay\Payboutique\ParametersTrait;

/**
 * Class AbstractRequest
 * @package Omnipay\Payboutique\Message
 */
abstract class AbstractRequest extends OmnipayAbstractRequest
{
    use ParametersTrait;

    /**
     * Omnipay Request Type
     * @var string
     */
    protected $requestType = 'createTransactionRequest';

    /**
     * @var null
     */
    protected $action = null;

    /**
     * AbstractRequest constructor.
     * @param ClientInterface $httpClient
     * @param HttpRequest $httpRequest
     */
    public function __construct(ClientInterface $httpClient, HttpRequest $httpRequest)
    {
        parent::__construct($httpClient, $httpRequest);
    }

    /**
     * Get data
     * @return mixed
     */
    public function getData()
    {
        $this->validate('amount', 'paymentMethod', 'userID', 'merchantID', 'siteAddress');

        return $this->getBaseData();
    }

    /**
     * @param mixed $data
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        $headers = array('Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8');

        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, [
            'xml' => $data
        ])->send();

        $content = new FluidXml(false);
        $content->add($httpResponse->getBody(true));

        return $this->response = new PurchaseResponse($this, $content);
    }

    /**
     * Get base data
     * @return FluidXml
     */
    public function getBaseData()
    {
        $data = new FluidXml(false);

        $message = $data->addChild('Message', ['version' => $this->getApiVersion()], true);

        $header = $message->addChild('Header', true);
        $header->addChild('Time', $this->getTime());

        $itentity = $header->addChild('Identity', true);
        $itentity->addChild('UserID', $this->getUserId());

        $body = $message->addChild('Body', ['type' => 'GetInvoice', 'live' => $this->getLive()], true);
        $order = $body->addChild('Order', ['paymentMethod' => $this->getPaymentMethod()], true);

        $order->addChild('MerchantID', $this->getMerchantId());
        $order->addChild('SiteAddress', $this->getSiteAddress());
        $order->addChild('PostbackURL', $this->getNotifyUrl());
        $order->addChild('SuccessURL', $this->getReturnUrl());
        $order->addChild('FailureURL', $this->getCancelUrl());

        return $message;
    }
}