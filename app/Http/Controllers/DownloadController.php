<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{

    /*-------------------------------------------
    |
    | View para Download do APP
    |
    |------------------------------------------*/
    public function download()
    {
        return view('download');
    }
}