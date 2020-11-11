<?php
session_start();

require_once("classes/Sql.php");

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
$last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
$zipcode = filter_input(INPUT_POST, 'zipcode');
$logradouro = filter_input(INPUT_POST, 'logradouro');
$number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT);
$neighborhood = filter_input(INPUT_POST, 'neighborhood', FILTER_SANITIZE_SPECIAL_CHARS);
$state = filter_input(INPUT_POST, 'state');
$complement = filter_input(INPUT_POST, 'complement');
$city = filter_input(INPUT_POST, 'city');


if($id){
    if( $first_name && $last_name && $zipcode && $logradouro && $number && $neighborhood && $state && $city ){
        $data = array(
            "first_name" => $first_name,
            "last_name" => $last_name,
            "zipcode" => $zipcode,
            "neighborhood" => $neighborhood,
            "number" => $number,
            "logradouro" => $logradouro,
            "complement" => $complement,
            "state" => $state,
            "city" => $city
            );
  
            $sql = new Sql();
            $sql = $sql->updateData($id, $data);
            header("Location: index.php ");
            exit;
    } else{
        $_SESSION['faltoPreencher'] = true;
        header("Location: form.php");
        exit;
    }
}elseif( $first_name && $last_name && $zipcode && $logradouro && $number && $neighborhood && $state && $city ){

        $data = array(
            "first_name" => $first_name,
            "last_name" => $last_name,
            "zipcode" => $zipcode,
            "neighborhood" => $neighborhood,
            "number" => $number,
            "logradouro" => $logradouro,
            "complement" => $complement,
            "state" => $state,
            "city" => $city
    );
    
    $sql = new Sql();
    
   $sql = $sql->insertData($data);
   if($sql){
       header("Location: /");
       exit;
   } else {
       header("Location: /from.php");
       exit;
   }

} else{
    header("Location: /form.php");
    exit;
}

?>