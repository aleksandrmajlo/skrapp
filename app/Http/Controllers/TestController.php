<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Tariff;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;


class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $test = env('APP_ENV');
        $bank_id = 2;
        $json_city = '
        [
    {
        "id": "0731cca0-620a-44a2-b809-8374c1505d6e",
        "city": "Абакан"
    },
    {
        "id": "0ff29066-7d2b-45bd-a32d-9d197dfa0d0d",
        "city": "Агинское"
    },
    {
        "id": "ac9e1416-e517-4405-8d76-99c9515c984f",
        "city": "Ярославль"
    },
    {
        "id": "45ad0d40-00fa-41a9-aa6b-8232de1f4a5c",
        "city": "Ярцево"
    }
   ]';

        $json_tariff= '
        {
          "tariffs": [
        {
            "id": "1cf8afe8-24cd-4400-829f-b6a9ec4bfc11",
            "name": "Наименование тарифа 1"
        },
        {
            "id": "6bc016e9-4950-4c79-83ca-00fa1883fa0b",
            "name": "Наименование тарифа 2"
        }
        ]
        }
        ';

        $bank_config = config('bank.2');
        $headers = [
            'Authorization' => 'Bearer ' . $bank_config['token'],
            'Accept' => 'application/json',
            'content-type' => 'multipart/form-data',
        ];
        $client = new Client([
            'base_uri' => $bank_config['host'],
        ]);
        // город
        try {
            $response = $client->request('GET',
                $bank_config['city'],
                ['headers' => $headers]
            )->getBody()->getContents();
            // тут добавляем города
        } catch (RequestException $e) {
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
            if ($test == 'testing') {
                $response = json_decode($json_tariff);
                if($response->tariffs){
                    Tariff::where('bank_id', $bank_id)->delete();
                    foreach ($response->tariffs as $item) {
                        $tariff = new Tariff();
                        $tariff->title = $item->name;
                        $tariff->idd = $item->id;
                        $tariff->bank_id = $bank_id;
                        $tariff->save();
                    }
                }

            }
        }
         // тариф
        try {
            $response = $client->request('GET',
                $bank_config['tariff'],
                ['headers' => $headers]
            )->getBody()->getContents();
            // тут добавляем тариф
        } catch (RequestException $e) {
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
            if ($test == 'testing') {
                $response = json_decode($json_city);
                City::where('bank_id', $bank_id)->delete();
                foreach ($response as $item) {
                    $city = new City();
                    $city->title = $item->city;
                    $city->idd = $item->id;
                    $city->bank_id = $bank_id;
                    $city->save();
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
