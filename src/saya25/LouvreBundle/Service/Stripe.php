<?php


namespace saya25\LouvreBundle\Service;
use Stripe\Charge;
use Stripe\Error\Card;


class Stripe
{

    /**
     * @var string
     */
    private $apiKey;


    /**
     * @var string
     */
    private $apiToken;


    public function __construct($apiKey, $apiToken)
    {
        $this->apiKey = $apiKey;
        $this->apiToken = $apiToken;
    }


    public function chargeCard($api, $token, $price){

        \Stripe\Stripe::setApiKey($api);


        try {
            Charge::create(array(
                "amount" =>  $price * 1000,
                "currency" => "eur",
                "source" => $token,
                "description" => "Billet musée du Louvre",
            ));
        } catch(\Stripe\Error\Card $e) {
            // paiement refusé
        }


    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getApiToken()
    {
        return $this->apiToken;
    }


}
