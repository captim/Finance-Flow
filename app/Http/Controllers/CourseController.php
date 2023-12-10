<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    function get()
    {
        $data = Http::timeout(160)->get("https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5")->json();
        return response()->json($data);
    }
}
