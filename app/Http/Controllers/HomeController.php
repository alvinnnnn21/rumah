<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gambar;

class HomeController extends Controller
{
    public function index()
    {
        $gambar = Gambar::all();

        return view("welcome")->with([
            "gambar" => $gambar
        ]);
    }
}
