<?php

namespace Omnipay\Payboutique\Message;

/**
 * Class CompletePurchaseResponse
 * @package Omnipay\Payboutique\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * Is successful
     * @return bool
     */
    public function isSuccessful()
    {
        if ($this->data['transactionReference']->query('/Message/Body/ReportedTransaction')) {
            return $this->validateChecksum();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->isSuccessful() ? 'OK' : 'ERR';
    }
}
