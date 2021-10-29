<?php

include_once "vendor/autoload.php";


function obtenerConexionApi($nombreApi)
{

    switch ($nombreApi) {
        case 'clientify_persona':
            return array("usuario" => "david@close.marketing", "pass" => "TZE1nzj*jgt4pvp1jwv", "apikey" => "70ad1153fbcc494a17d5b6b2aaf7cb06dc1f89a4", "URL" => "https://api.clientify.net/v1/contacts/");
            break;
        case 'clientify_compania':
            return array("usuario" => "david@close.marketing", "pass" => "TZE1nzj*jgt4pvp1jwv", "apikey" => "70ad1153fbcc494a17d5b6b2aaf7cb06dc1f89a4", "URL" => "https://api.clientify.net/v1/companies/");
            break;
        case "holded":
            return array("usuario" => "info@close.marketing", "pass" => "abp2dye*axk0jyh_QKG", "apikey" => "c49afe188c171ed9316a59cd334f1891", "URL" => 'https://api.holded.com/api/invoicing/v1/contacts');
            break;
        default:
            return array("error" => "no hay ninguna api con ese nombre");
            break;
    }
}

function obtenerPersonasClientify()
{

    $apivalues = obtenerConexionApi("clientify_persona");
    $URL=$apivalues["URL"];

    $apikey = $apivalues["apikey"];

    $client = new GuzzleHttp\Client();
    $res = $client->request(
        'GET',
        $URL,
        [
            'headers' => [
                "Authorization" => "Token " . $apikey . "",
                "Content-Type" => "application/json"
            ]
        ]
    );
    //convertimos la respues JSON a array asociativo, usamos foreach para recorrerlo
    $responseJson = $res->getBody()->getContents();

    return $responseJson;

}

function obtenerCompaniasClientify()
{

    $apivalues = obtenerConexionApi("clientify_compania");
    $URL=$apivalues["URL"];
    $apikey = $apivalues["apikey"];

    $client = new GuzzleHttp\Client();
    $res = $client->request(
        'GET',
        $URL,
        [
            'headers' => [
                "Authorization" => "Token " . $apikey . "",
                "Content-Type" => "application/json"
            ]
        ]
    );
    //convertimos la respues JSON a array asociativo, usamos foreach para recorrerlo
    $responseJson = $res->getBody()->getContents();   
    return $responseJson;
}

/*obtenerPersonasClientify();
obtenerCompaniasClientify();*/
