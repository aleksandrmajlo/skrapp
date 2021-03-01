<?php

return [

    '2'=>[
        'token'=>env('BANK_OTKRYTIE'),
         'host'=>'https://openpartners.ru',

         'add'=>'/api/v2/request/add',
         'test_add'=>'/api/v2/request/add/test',

         'get_status'=>'/api/v2/request/status?id=',
         'get_status_test'=>'/api/v2/request/status/test?id=',

         'inn_dublicate'=>'/api/v2/request/getduplicates',
         'inn_dublicate_test'=>'/api/v2/request/getduplicates/test',

         'inn_dublicate_get'=>'/api/v2/request/getduplicates?id=',
         'inn_dublicate_get_test'=>'/api/v2/request/getduplicates/test?id=',

         'city'=>'/api/v2/dictionaries/city',
         'tariff'=>'/api/v2/dictionaries/tariff',

          'status'=>[
              'created'=>3,
              'success'=>1,
              'fail'=>1
          ]

    ]

];
