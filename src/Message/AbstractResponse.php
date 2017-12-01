<?php

namespace Omnipay\Payboutique\Message;

use FluidXml\FluidXml;
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
        /** @var FluidXml $xml */
        $xml = $this->data['transactionReference'];

        $userId      = strip_tags($xml->query('/Message/Header/Identity/UserID')->html());
        $checksum    = strip_tags($xml->query('/Message/Header/Identity/Checksum')->html());
        $time        = strip_tags($xml->query('/Message/Header/Time')->html());
        $referenceId = strip_tags($xml->query('/Message/Body/ReportedTransaction/ReferenceID')->html());


        if (!$referenceId || !$checksum || !$time || !$referenceId) {
            return false;
        }

        $hashParts = [
            strtoupper($userId),
            strtoupper(hash('sha512', $this->data['password'])),
            strtoupper($time),
            $referenceId
        ];

        $signature = strtoupper(hash('sha512', implode('', $hashParts)));

        if ($checksum === $signature) {
            return true;
        }

        return false;
    }
}
