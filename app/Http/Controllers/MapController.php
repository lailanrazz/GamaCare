<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
public function index()
{
    $data = [
        "title" => "GamaCare : Sistem Informasi Layanan Kesehatan Mental UGM",
        "title1" => "GamaCare : Sistem Informasi Layanan Kesehatan Mental UGM",
    ];

    if (auth()->check()) {
        return view('index', $data);
    } else {

    return view('index-public',$data);
    }
}
public function table()
{
    $data = [
        "title" => "GamaCare",
    ];
    return view('table', $data);
}
}
