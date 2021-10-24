<?php

function obtenerConexionApi($nombreApi)
{

    switch ($nombreApi) {
        case 'clientify':
            return array("usuario" => "david@close.marketing", "pass" => "TZE1nzj*jgt4pvp1jwv", "apikey" => "70ad1153fbcc494a17d5b6b2aaf7cb06dc1f89a4", "URL" => "https://api.clientify.net/v1/contacts/");
            break;
        case "holded":
            return array("usuario" => "info@close.marketing", "pass" => "abp2dye*axk0jyh_QKG", "apikey" => "c49afe188c171ed9316a59cd334f1891", "URL" => 'https://api.holded.com/api/invoicing/v1/contacts');
            break;
        default:
            return array("error" => "no hay ninguna api con ese nombre");
            break;
    }
}


/* CLIENTIFY CLIENTIFY CLIENTIFY CLIENTIFY CLIENTIFY CLIENTIFY */



/* crea un nuevo contacto en clientify 
owner_name ->nombre de contacto , id->id identificativo , owner->email del contacto */

function nuevoContactoClientify($owner_name, $id, $owner)
{

    $apiValues = obtenerConexionApi("clientify");

    $usuario = $apiValues["usuario"];
    $pass = $apiValues["pass"];
    $apikey = $apiValues["apikey"];
    $URL = $apiValues["URL"];
    //$customId=array("field"=>"absoluteId","value"=>$id);

    $headers = array("Authorization: token $apikey", 'Content-Type: application/json');
    $datos = array(
        'first_name' => $owner_name,
        'custom_fields' => array(array("field"=>"holded_id","value"=>$id)),
        'email' => $owner
    );

    $cuerpoJson = json_encode($datos);
    //echo $cuerpoJson;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $cuerpoJson);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "$usuario:$pass");


    $result = curl_exec($ch);

    curl_close($ch);

    /*echo "<pre>";
    print_r($result);
    echo "</pre>";*/
}

/* Nos devuelve un array con todos los clientes de Clientify */
function clientifyClientesTodos()
{

    /*$usuario ="david@close.marketing";
    $pass ="TZE1nzj*jgt4pvp1jwv";
    $apikey ="70ad1153fbcc494a17d5b6b2aaf7cb06dc1f89a4";
    $URL = 'https://api.clientify.net/v1/contacts/';*/

    $apiValues = obtenerConexionApi("clientify");

    $usuario = $apiValues["usuario"];
    $pass = $apiValues["pass"];
    $apikey = $apiValues["apikey"];
    $URL = $apiValues["URL"];
    $headers = array("Authorization: token $apikey");

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "$usuario:$pass");

    $result = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return $result;
}

/* Nos devuelve un array con todos los clientes de Clientify  cuyo campo custom coincide con el nombre y valor proporcionado */
function clientifyClientesCustomfield($nombreCampo,$valorCampo){

    $apiValues = obtenerConexionApi("clientify");

    $usuario = $apiValues["usuario"];
    $pass = $apiValues["pass"];
    $apikey = $apiValues["apikey"];
    $URL = $apiValues["URL"]."?$nombreCampo=$valorCampo";
    $headers = array("Authorization: token $apikey");

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "$usuario:$pass");

    $result = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return $result;
}

/* modifica un cliente dado un id de clientify , y los campos necesarios de holded, en este caso nombre de usuario en holded y su direccion de email*/

function modificarClienteClientify($idContactoClientify,$nombreHolded,$emailHolded){

    $apiValues = obtenerConexionApi("clientify");

    $usuario = $apiValues["usuario"];
    $pass = $apiValues["pass"];
    $apikey = $apiValues["apikey"];
    //$URL = $apiValues["URL"]."$idContactoClientify"."/";
    $URL = $apiValues["URL"].$idContactoClientify."/";
    $headers = array("Authorization: token $apikey");

    $curl = curl_init();

    $arrayDatos=array("first_name"=>$nombreHolded,"email"=>$emailHolded);

    curl_setopt_array($curl, array(
    CURLOPT_URL => $URL,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS =>json_encode($arrayDatos),
    CURLOPT_HTTPHEADER => array(
        "Authorization: Token ".$apikey."",
        'Content-Type: application/json'
    ),
    ));

$response = curl_exec($curl);

curl_close($curl);

}
/* HOLDED HOLDED HOLDED HOLDED HOLDED */

/* modificar contacto holden */

function modificarContactoHolded($name, $customId, $email)
{
}

/* crea un nuevo contacto en holded */

function nuevoContactoHolded($name, $customId, $email)
{

    /*$usuario ="info@close.marketing";
    $pass ="abp2dye*axk0jyh_QKG";
    $apikey ="c49afe188c171ed9316a59cd334f1891";
    $URL = 'https://api.holded.com/api/invoicing/v1/contacts';*/

    $apiValues = obtenerConexionApi("holded");

    $usuario = $apiValues["usuario"];
    $pass = $apiValues["pass"];
    $apikey = $apiValues["apikey"];
    $URL = $apiValues["URL"];

    $headers = array("key: $apikey");

    $datos = array(
        'name' => $name,
        'customId' => $customId,
        'email' => $email
    );

    $query_string = http_build_query($datos);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "$usuario:$pass");


    $result = curl_exec($ch);

    curl_close($ch);

    print_r($result);
}

/* Nos devuelve un array con todos los clientes de Holded */
function holdedClientesTodos()
{

    /*$usuario ="info@close.marketing";
    $pass ="abp2dye*axk0jyh_QKG";
    $apikey ="c49afe188c171ed9316a59cd334f1891";
    $URL = 'https://api.holded.com/api/invoicing/v1/contacts';*/

    $apiValues = obtenerConexionApi("holded");

    $usuario = $apiValues["usuario"];
    $pass = $apiValues["pass"];
    $apikey = $apiValues["apikey"];
    $URL = $apiValues["URL"];

    $headers = array("key: $apikey");


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "$usuario:$pass");

    $result = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);


    return $result;
}


/* SINCRONIZAR SINCRONIZAR SINCRONIZAR SINCRONIZAR SINCRONIZAR SINCRONIZAR*/

/* para actualizar o crear , contactos de holder EN clientify , segun los tengamos en holder */

function sincronizarHolderClientify(){

    //coger contactos de holder
    $arrayContactosHolded=json_decode(holdedClientesTodos());
    echo "<div class='col-md-6'>Holded<pre>";
    print_r($arrayContactosHolded[0]);
    echo "</pre></div>";

    //coger contactos de clientify
    $arrayContactosClientify=json_decode(clientifyClientesTodos());
    echo "<div class='col-md-6'>Clientify<pre>";
    print_r($arrayContactosClientify->results[0]);
    echo "</pre></div>";
    
    //recorro los clientes de holded y cojo su id de HOLDED
    foreach ($arrayContactosHolded as $key) {

        $contactoHoldedId = $key->id;
        //echo "holded ->".$key->name . "<br>";
        $crearContacto=true;
        //recorro los clientes de clientify y cojo su id de Clientify        
        foreach ($arrayContactosClientify->results as $key2) {
            //echo "clientify ->".$key2->first_name . "<br>";
            
            //el custom field 0, es el que hemos llamado holded_id en custom_fields de clientify         
            if(isset($key2->custom_fields[0]->value)){
                $contactoClientifyId=$key2->custom_fields[0]->value;                

                //si los ids coinciden, son el mismo contacto , asi que lo actualizamos
                if( $contactoHoldedId == $contactoClientifyId){                   
                   modificarClienteClientify($key2->id,$key->name,$key->email);                  
                    $crearContacto=false;
                }
            
            }
        
        }
        if($crearContacto==true){            
           nuevoContactoClientify($key->name,$key->id,$key->email);
        }

    }

}

