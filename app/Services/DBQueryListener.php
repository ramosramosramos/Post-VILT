<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DBQueryListener
{
    public function listenQuery(){
        DB::listen(function ($query) {
               return dd($query);


        });
    }

}
