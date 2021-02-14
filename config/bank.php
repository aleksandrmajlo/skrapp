<?php

return [

    '2'=>[
        'token'=>env('BANK_OTKRYTIE'),
         'host'=>'https://openpartners.ru',

         'add'=>'/api/v2/request/add',
         'test_add'=>'/api/v2/request/add/test',

         'get_status'=>'/api/v2/request/status?id=',
         'get_status_test'=>'/api/v2/request/status/test?id=',

         'city'=>'/api/v2/dictionaries/city',
         'tariff'=>'/api/v2/dictionaries/tariff',

    ]

];
