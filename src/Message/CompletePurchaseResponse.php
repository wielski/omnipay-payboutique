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

    /**
     * @return string
     */
    public function confirm()
    {
        $this->exitWith('OK');
    }

    /**
     * @return string
     */
    public function error()
    {
        $this->exitWith('ERR');
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $result
     */
    public function exitWith($result)
    {
        header('Content-Type: text/plain; charset=utf-8');
        echo $result;
        exit;
    }
}
