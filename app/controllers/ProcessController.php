<?php

class ProcessController extends \BaseController {

    public function index() {
        
    }

    public function payment() {
        Conekta::setApiKey("key_yVL2GZrKn87qN2rE");
        try {
            $charge = Conekta_Charge::create(array(
            "amount" => 5000,
            "currency" => "MXN",
            "description" => "CPMX5 Payment",
            "reference_id"=> "orden_de_id_interno",
            "card" => $_POST['conektaTokenId'] //"tok_a4Ff0dD2xYZZq82d9"
            ));
        } catch (Conekta_Error $e) {
           return View::make('payment',array('message'=>$e->getMessage()));
        }
        
        return View::make('payment',array('message'=>$charge->status));
        
    }

}
