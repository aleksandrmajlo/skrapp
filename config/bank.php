<?php

return [

    '2'=>[
        'token'=>env('BANK_OTKRYTIE'),
         'host'=>'https://openpartners.ru',
         'add'=>'/api/v2/request/add',
         'test_add'=>'/api/v2/request/add/test',
         'city'=>'/api/v2/dictionaries/city',
         'tariff'=>'/api/v2/dictionaries/tariff'
    ]

];
