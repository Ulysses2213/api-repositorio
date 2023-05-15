<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class RespoController extends Controller
{

    public function getRepos()
    {
        $repos = DB::select('select * from repository');
        return json_decode(json_encode($repos));
    }

}
