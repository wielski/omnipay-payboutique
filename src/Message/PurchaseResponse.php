<?php

namespace Omnipay\Payboutique\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class PurchaseResponse
 * @package Omnipay\Payboutique\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Is successful
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getResultCode() === 1;
    }

    /**
     * Return status code
     * @return int
     */
    public function getResultCode()
    {
        $errors = $this->data->query('/Message/Body/Errors');

        if ($errors->size()) {
            return 0;
        }

        return 1;
    }

    /**
     * Is redirect
     * @return string|bool
     */
    public function isRedirect()
    {
        if ($this->getResultCode() !== 1) {
            return false;
        }

        $redirect = $this->data->query('/Message/Body/Order/RedirectURL');
        if ($redirect->size()) {
            return true;
        }

        return false;
    }

    /**
     *
     */
    public function getRedirectUrl()
    {
        $order = $this->data->query('/Message/Body/Order/RedirectURL')->array();
        $order = array_shift($order);

        if ($order) {
            return $order->nodeValue;
        }

        return false;
    }

    /**
     * Redirect method
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * Redirect data
     * @return mixed
     */
    public function getRedirectData()
    {
        return [];
    }

    /**
     * Text description of the status.
     *
     * @return string|null
     */
    public function getMessage()
    {
        $response = [];

        if ($messages = $this->data->query('/Message/Body/Errors')->array()) {
            foreach ($messages as $message) {
                $response[] = $message->textContent;
            }
        }

        return count($response) ? implode(', ', $response) : null;
    }

    /**
     * @param bool $serialize
     * @return string
     */
    public function getTransactionReference($serialize = true)
    {
        $data = $this->data->query('/Message/Body')->array();

        if (count($data)) {
            return json_encode($data);
        }

        return '';
    }
}