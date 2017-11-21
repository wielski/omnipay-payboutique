<?php

namespace Omnipay\Payboutique\Message;

use FluidXml\FluidXml;

/**
 * Class CompletePurchaseRequest
 * @package Omnipay\Payboutique\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * Complete purchase data
     * @return array
     */
    public function getData()
    {
        $reference = new FluidXml(false);
        $reference->add($this->getTransactionReference());

        return [
            'password'             => $this->getPassword(),
            'userId'               => $this->getUserId(),
            'merchantId'           => $this->getMerchantId(),
            'transactionReference' => $reference
        ];
    }

    /**
     * @param $data
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
