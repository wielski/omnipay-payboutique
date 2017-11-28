<?php

namespace Omnipay\Payboutique;

/**
 * Class Gateway
 * @package Omnipay\Payboutique
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Payboutique';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'endpoint'      => 'https://merchant.payb.lv/xml_service',
            'paymentMethod' => 'CreditCard',
            'apiVersion'    => '0.5',
            'live'          => 'true',
            'userID'        => '',
            'merchantID'    => '',
            'siteAddress'   => '',
            'password'      => '',
            'date'          => date('c')
        );
    }
}
