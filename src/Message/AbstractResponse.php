<?php

namespace Omnipay\Payboutique\Message;

use Omnipay\Common\Message\AbstractResponse as OmnipayAbstractResponse;

/**
 * Class AbstractRequest
 * @package Omnipay\Payboutique\Message
 */
abstract class AbstractResponse extends OmnipayAbstractResponse
{
    /**
     * Validate Checksum
     * @return bool
     */
    public function validateChecksum()
    {
        $userId = array_shift($this->data['transactionReference']->query('/Message/Header/Identity/UserID')->array());
        $checksum = array_shift($this->data['transactionReference']->query('/Message/Header/Identity/Checksum')->array());
        $time = array_shift($this->data['transactionReference']->query('/Message/Header/Time')->array());
        $referenceId = array_shift($this->data['transactionReference']->query('/Message/Body/ReportedTransaction/ReferenceID')->array());

        if (!$referenceId || !$checksum || !$time || !$referenceId) {
            return false;
        }

        $hashParts = [
            strtoupper($userId->nodeValue),
            strtoupper(hash('sha512', $this->data['password'])),
            strtoupper($time->nodeValue),
            $referenceId->nodeValue
        ];

        $signature = strtoupper(hash('sha512', implode('', $hashParts)));

        if ($checksum->nodeValue === $signature) {
            return true;
        }

        return false;
    }
}
