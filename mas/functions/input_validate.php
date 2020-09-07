<?php 



function validate_input($input){
    
    $input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $input;

}

function isMail($check_mail)
{
    
    if(filter_var($check_mail, FILTER_VALIDATE_EMAIL)){
        return true;
    }
}


function isNumber($input){
 if (strlen($input) > 13 || strlen($input) < 10) {
     
 }else{
    if (is_numeric($input)) { return true; } else { return false; }
  }
 }
?>