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

        if ($description = $this->getDescription()) {
            $data->query('/Message/Body/Order')->addChild('Description', $description);
        }

        if ($orderId = $this->getOrderId()) {
            $data->query('/Message/Body/Order')->addChild('OrderID', $orderId);
        }

        if ($accountId = $this->getAccountId()) {
            $data->query('/Message/Body/Order')->addChild('AccountID', $accountId);
        }

        $data->query('/Message/Header/Identity')->addChild('Signature', $this->getSignature());

        return $data->xml(true);
    }
}
