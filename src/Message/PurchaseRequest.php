<?php

namespace Omnipay\Payboutique\Message;

/**
 * Class PurchaseRequest
 * @package Omnipay\Payboutique\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @return \FluidXml\FluidXml
     */
    public function getData()
    {
        $this->validate('amount', 'paymentMethod', 'userID', 'merchantID', 'siteAddress');

        $data = $this->getBaseData();

        $data->query('/Message/Body/Order')->addChild('MerchantCurrency', $this->getCurrency());
        $data->query('/Message/Body/Order')->addChild('AmountMerchantCurrency', $this->getAmount());
        $data->query('/Message/Body/Order')->addChild('Description', $this->getDescription());
        $data->query('/Message/Body/Order')->addChild('OrderID', $this->getOrderId());

        $data->query('/Message/Header/Identity')->addChild('Signature', $this->getSignature());

        return $data->xml(true);
    }
}
