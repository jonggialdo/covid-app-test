<?php

use GuzzleHttp\Client;

function ApiProv()
{
    $client = new Client();
    $response = $client->request('get', 'https://data.covid19.go.id/public/api/prov.json');
    $result = $response->getBody()->getContents();
    $result = json_decode($result, true);

    return $result['list_data'];
}

function ApiRS()
{
  $client = new Client();
  $response = $client->request('get', 'https://data.covid19.go.id/public/api/rs.json');
  $result = $response->getBody()->getContents();
  $result = json_decode($result, true);

  return $result;
}

function CaseByProv($prov_key)
{
    $result = ApiProv();
    return $result[$prov_key];
}

function ProvName($prov_key)
{
    $result = CaseByProv($prov_key);
    return $result['key'];
}

function TotalCase($prov_key)
{
    $result = CaseByProv($prov_key);
    return str_replace(',', '.', number_format($result['jumlah_kasus']));
}

function TotalSembuh($prov_key)
{
    $result = CaseByProv($prov_key);
    return str_replace(',', '.', number_format($result['jumlah_sembuh']));
}

function TotalMeninggal($prov_key)
{
    $result = CaseByProv($prov_key);
    return str_replace(',', '.', number_format($result['jumlah_meninggal']));
}

function TotalCaseByGender($key)
{
    $result = ApiProv();
    $total = 0;

    foreach($result as $res){
        $total += (int)$res['jenis_kelamin'][$key]['doc_count'];
    }

    return str_replace(',', '.', number_format($total));
}

function renderDataRS()
{
    $data = ApiRS();

    for($i = 0;$i < sizeof($data); $i++){
        if(!array_key_exists('telepon', $data[$i])){
            $data[$i]['telepon'] = ' ';
        }elseif($data[$i]['telepon'] == '' || $data[$i]['telepon'] == NULL){
            $data[$i]['telepon'] = ' ';
        }

        $data[$i]['coordinate'] = '';

        if(array_key_exists('lokasi', $data[$i])){
            if($data[$i]['lokasi']['lat'] != 0 && $data[$i]['lokasi']['lon'] != 0){
                $data[$i]['coordinate'] = $data[$i]['lokasi']['lat'].','.$data[$i]['lokasi']['lon'];
            }
        }
    }

    return $data;
}
