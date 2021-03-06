<?php

$action = "";

/*cargador de funciones por GET */
if (isset($_GET["action"]) && strlen($_GET["action"]) > 0)
    $action = $_GET["action"];

switch ($action) {
    case 'sincronizarHoldedClientify':
        sincronizarHolderClientify();
        break;
    case 'borrarHoldedTodos':
        borrarTodoHolded();
        break;
    
}


/* valores necesarios para usar las apis */

function obtenerConexionApi($nombreApi)
{

    switch ($nombreApi) {
        case 'clientify':
            return array("usuario" => "correoparaclientify", "pass" => "TZE1nzj*jgt4pvp1jwv", "apikey" => "70ad1153fbcc494a17d5b6b2aaf7cb06dc1f89a4", "URL" => "https://api.clientify.net/v1/contacts/");
            break;
        case "holded":
            return array("usuario" => "correoparaholded", "pass" => "abp2dye*axk0jyh_QKG", "apikey" => "c49afe188c171ed9316a59cd334f1891", "URL" => 'https://api.holded.com/api/invoicing/v1/contacts');
            break;
        default:
            return array("error" => "no hay ninguna api con ese nombre");
            break;
    }
}

/* CLIENTIFY CLIENTIFY CLIENTIFY CLIENTIFY CLIENTIFY CLIENTIFY CLIENTIFY */

/* modifica un contacto de clientify al ,le pasamos como argumento el id del contacto */

function modificarContactoClientify($clientifyId, $arrayClientify)
{

    $apiValues = obtenerConexionApi("clientify");

    $apikey = $apiValues["apikey"];
    $URL = $apiValues["URL"] . $clientifyId . "/";
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => json_encode($arrayClientify),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Token " . $apikey . "",
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}

/* Nos devuelve un array con todos los clientes de Clientify  cuyo campo custom coincide con el nombre proporcionado */
function clientifyClientesCustomfield($nombreCampo)
{

    $apiValues = obtenerConexionApi("clientify");

    $usuario = $apiValues["usuario"];
    $pass = $apiValues["pass"];
    $apikey = $apiValues["apikey"];
    $URL = $apiValues["URL"] . "?$nombreCampo";
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

/* nos devuelve un array con las empresas que tienen un campo custom, le pasamos el nombre del campo como variable */

function clientifyEmpresaCustomfield($nombreCampo)
{

    $apivalues = obtenerConexionApi("clientify");
    $apikey = $apivalues['apikey'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.clientify.net/v1/companies/?$nombreCampo",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "Authorization: Token $apikey"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

/* modifica una empresa existente en clientify */

function modificarEmpresaClientify($idClientify, $arrayClientify)
{

    $apivalue = obtenerConexionApi("clientify");
    $apikey = $apivalue['apikey'];
    $arrayClientify = json_encode($arrayClientify);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.clientify.net/v1/companies/' . $idClientify . '/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $arrayClientify,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "Authorization: Token $apikey"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}

/* crea un nuevo contacto tipo empresa en clientify */

function nuevoEmpresaClientify($arrayClientify)
{

    $apiValues = obtenerConexionApi("clientify");
    $arrayClientify = json_encode($arrayClientify);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.clientify.net/v1/companies/?api_key=" . $apiValues['apikey'] . "&format=json",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $arrayClientify,
        CURLOPT_HTTPHEADER => array(
            'format: json',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}

/* crea un nuevo contacto en clientify , usa como parametro un array con las propiedades que vamos a "insertar" en clientify */

function nuevoContactoClientify($arrayContactos)
{

    $apiValues = obtenerConexionApi("clientify");

    $usuario = $apiValues["usuario"];
    $pass = $apiValues["pass"];
    $apikey = $apiValues["apikey"];
    $URL = $apiValues["URL"];
    $headers = array("Authorization: token $apikey", 'Content-Type: application/json');

    /* comprobamos que las variables existen, en caso contrario podria dar error y ponerlo como requisito, por ahora, lo pondremos a vacio */
    if (isset($arrayContactos["first_name"]))
        $first_name = $arrayContactos["first_name"];
    else
        $first_name = "";

    if (isset($arrayContactos["email"]))
        $email = $arrayContactos["email"];
    else
        $email = "";

    if (isset($arrayContactos["phones"][0]["phone"]))
        $phone = $arrayContactos["phones"][0]["phone"];
    else
        $phone = "";

    if (isset($arrayContactos["custom_fields"][0]["value"]))
        $custom_fields = array(array("field" => "holded_id", "value" => $arrayContactos["custom_fields"][0]["value"]));
    else
        $custom_fields = "";

    $ch = curl_init();
    $contacto = array(
        "first_name" => $first_name,
        "email" => $email,
        "phone" => $phone,
        "custom_fields" => $custom_fields,
        "addresses" => array(array("type" => 1, "street" => $arrayContactos['addresses'][0]['street']))
    );


    $contacto = json_encode($contacto);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $contacto);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "$usuario:$pass");

    $result = curl_exec($ch);

    curl_close($ch);

    return json_encode($result);
}


/* HOLDED HOLDED HOLDED HOLDED HOLDED HOLDED HOLDED HOLDED HOLDED HOLDED */


/* Nos devuelve un array con todos los clientes de Holded */

function borrarTodoHolded(){
    
    $apiValues=obtenerConexionApi("holded");
    $apikey=$apiValues["apikey"];
    $contactosHolded=json_decode(holdedClientesTodos());

   /* foreach ($contactosHolded as $key) {
        $id=$key->id;
    }*/
    $ch = curl_init();

    foreach ($contactosHolded as $key) {
        $URL="https://api.holded.com/api/invoicing/v1/contacts/$key->id";
        $headers=array("Accept: application/json","key: $apikey");
    
         curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
     
         $response = curl_exec($ch);
         var_dump($response);
    }
   
     curl_close($ch);
 
}

function holdedClientesTodos()
{

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

/* para actualizar o crear contactos de holder EN clientify , segun los tengamos en holder */

function sincronizarHolderClientify()
{
    /* respuesta que devolveremos cuando el script se ejecute */
    $resultado = array("status" => true);

    //obtenemos contactos de holder
    $arrayContactosHolded = json_decode(holdedClientesTodos());

    //obtenemos todos los contactos de clientify que tengan el atributo holded_id (lo cual significaria que ha sido exportado desde holded)) */
    $arrayClientifyCustomField = (clientifyClientesCustomfield("holded_id"));
    $arrayClientifyCustomField = json_decode($arrayClientifyCustomField);
    $arrayEmpresaCustomField = clientifyEmpresaCustomfield("holded_id");
    $arrayEmpresaCustomField = json_decode($arrayEmpresaCustomField);

    //recorro los clientes de holded y cojo su id de HOLDED
    foreach ($arrayContactosHolded as $key) {

        $crear = true;

        /* id de holded que usaremos en clientify*/
        $holdedId = $key->id;

        /* nombre holded que usaremos en clientify*/
        $holdedName = $key->name;

        /* email de holded que usaremos en clientify*/
        $holdedEmail = $key->email;

        /* numero movil de holded que usaremos en clientify*/
        $holdedMovil = $key->mobile;

        /* numero de telefono de la empresa de holded que usaremos en clientify*/
        $holdedTrabajo = $key->phone;

        /* direccion de holded que usaremos en clientify*/
        $holdedDireccion = $key->billAddress->address;

        /* boleano para saber si es persona o empresa */
        $holdedPerson = $key->isperson;

        if ($holdedPerson == 1) {
            //ES PERSONA
            $arrayClientify = array(
                "custom_fields" => array(
                    array("field" => "holded_id", "value" => $holdedId),
                ),
                "first_name" => $holdedName,
                "email" => $holdedEmail,
                "addresses" => array(
                    array("type" => 1, "street" => $holdedDireccion)
                ),
                "phones" => array(
                    array("phone" => $holdedMovil, "type" => 2),
                    array("phone" => $holdedTrabajo, "type" => 3)
                ),
            );
            /* comparamos con el array de clientes con holded_id */
            foreach ($arrayClientifyCustomField->results as $key2) {

                /* obtenemos el valor del campo holded_id para compararlo con el del contacto actual holded , usaremos para ello la variable holded_id creada anteriormente */
                if(isset($key2->custom_fields[0]->value)){
                    $clientifyHoldedId = $key2->custom_fields[0]->value;
                    $idClientify = $key2->id;

                    if ($clientifyHoldedId == $holdedId) {
                        if ($holdedPerson == 1) {
                            modificarContactoClientify($idClientify, $arrayClientify);
                            $crear = false;
                            break;
                        }
                    }
                }
            }
        } else {
            // ES EMPRESA
            $arrayClientify = array(
                "custom_fields" => array(
                    array("field" => "holded_id", "value" => $holdedId),
                ),
                "addresses" => array(
                    array("type" => 1, "street" => $holdedDireccion)
                ),
                "name" => $holdedName,
                "phones" => array(
                    array("phone" => $holdedTrabajo, "type" => 3)
                ),
                "emails" => array(array("email" => $holdedEmail)),
            );

            /* comparamos con el array de empresas con holded_id */
            foreach ($arrayEmpresaCustomField->results as $key2) {
                
                /* obtenemos el valor del campo holded_id para compararlo con el del contacto actual holded , usaremos para ello la variable holded_id creada anteriormente */
                    if(isset($key2->custom_fields[0]->value)){
                        $clientifyHoldedId = $key2->custom_fields[0]->value;
                        $idClientify = $key2->id;

                        if ($clientifyHoldedId == $holdedId) {
                            modificarEmpresaClientify($idClientify, $arrayClientify);
                            $crear = false;
                            break;
                        }
                    }
            }
        }        

        /* si el boleano es true, es una persona y lo a??adiremos como nuevo contacto , en caso contrario es una empresa */
        if ($crear && $key->isperson == 1){
            echo "NUEVO PERSONA <->";
            nuevoContactoClientify($arrayClientify);
        }
        if ($crear && $key->isperson != 1){
            echo "NUEVO PERSONA <->";
            nuevoEmpresaClientify($arrayClientify);
        }
    }

    /* devolvemos la respuesta AJAX como json para recogerla en la pagina indicada */
    echo json_encode($resultado);
}
