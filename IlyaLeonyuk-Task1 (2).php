<?php
class CardValidate {
    private $cardnumber;

    function set_number($cardnumber) {
        $this->cardnumber  = $cardnumber;
    }

    function validate() {
        $c = str_replace(" ","",$this->cardnumber);
        $sum = 0;
        

        for ($i = 0, $j = strlen($c); $i < $j; $i++) {
            if ((($i + 1) % 2) == 0) {
                $value = $c[$i];
            } else {            
                $value = $c[$i] * 2;
                if ($value > 9) {
                    $value = $value - 9;
                }
            }
            $sum = $sum + $value;
        }
        return $sum % 10 == 0; 
    }

    function emit() {
        $emit = $this->cardnumber[0] . $this->cardnumber[1];
        
        if ($emit == "62") {
            return "Mastercard";
        } elseif ($emit == "67") { 
            return "Mastercard";
        } elseif (preg_match("/5[0-5]/",$emit) == 1) {
            return "Mastercard";
        } elseif ($emit == "14") {
            return "VISA";
        } elseif (preg_match("/4[0-9]/",$emit) == 1) {
            return "VISA";
        }

        
        return "";
    }

}

if ($argv[1] == "validate") {
    echo("Number:");
    
    $input = preg_replace("/\s+/","",(fgets(STDIN, 1024)));
    
    $instance = new CardValidate();
    $instance->set_number($input);

    $valid = $instance -> validate($input);
    
    if ($valid == "true") {
        $valid = "Валидная";
    } else {
        $valid = "Невалидная";
    }

    $emit = $instance -> emit($input);

    echo($valid . ' ' . $emit . "\n");
}

?>