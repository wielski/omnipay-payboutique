<?php

namespace Omnipay\Payboutique;

/**
 * Trait ParametersTrait
 * @package Omnipay\Payboutique
 */
trait ParametersTrait
{
    /**
     * Get Endpoint
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    /**
     * Set Endpoint
     * @param $value
     * @return mixed
     */
    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    /**
     * Get User ID
     * @return mixed
     */
    public function getUserId()
    {
        return $this->getParameter('userID');
    }

    /**
     * Set User ID
     * @param $value
     * @return mixed
     */
    public function setUserId($value)
    {
        return $this->setParameter('userID', $value);
    }

    /**
     * Get Merchant ID
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantID');
    }

    /**
     * Set Merchant ID
     * @param $value
     * @return mixed
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantID', $value);
    }

    /**
     * Get Site Address
     * @return mixed
     */
    public function getSiteAddress()
    {
        return $this->getParameter('siteAddress');
    }

    /**
     * Set Site Address
     * @param $value
     * @return mixed
     */
    public function setSiteAddress($value)
    {
        return $this->setParameter('siteAddress', $value);
    }

    /**
     * Get Live Flag
     * @return mixed
     */
    public function getLive()
    {
        return $this->getParameter('live');
    }

    /**
     * Set Live Flag
     * @param $value
     * @return mixed
     */
    public function setLive($value)
    {
        return $this->setParameter('live', $value);
    }

    /**
     * Get API Version
     * @return mixed
     */
    public function getApiVersion()
    {
        return $this->getParameter('apiVersion');
    }

    /**
     * Set API Version
     * @param $value
     * @return mixed
     */
    public function setApiVersion($value)
    {
        return $this->setParameter('apiVersion', $value);
    }

    /**
     * Get Password
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set Password
     * @param $value
     * @return mixed
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Set Time
     * @return string
     */
    public function setTime($value)
    {
        return $this->setParameter('time', $value);
    }

    /**
     * Get Time
     * @return string
     */
    public function getTime()
    {
        return $this->getParameter('time');
    }

    /**
     * Set Time
     * @return string
     */
    public function setOrderId($value)
    {
        return $this->setParameter('orderID', $value);
    }

    /**
     * Get Time
     * @return string
     */
    public function getOrderId()
    {
        return $this->getParameter('orderID');
    }

    /**
     * Set Account ID
     * @return string
     */
    public function setAccountId($value)
    {
        return $this->setParameter('accountId', $value);
    }

    /**
     * Get Account ID
     * @return string
     */
    public function getAccountId()
    {
        return $this->getParameter('accountId');
    }

    /**
     * Get signature
     * @return string
     */
    public function getSignature()
    {
        $hashParts = [
            strtoupper($this->getUserId()),
            strtoupper(hash('sha512', $this->getPassword())),
            strtoupper($this->getTime())
        ];

        return strtoupper(hash('sha512', implode('', $hashParts)));
    }
}