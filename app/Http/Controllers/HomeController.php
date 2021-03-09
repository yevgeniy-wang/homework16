<?php


namespace App\Http\Controllers;


use App\Models\Ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class HomeController
{
    public function __invoke()
    {
        $ads = Ad::paginate(5);

        return view('pages.index', compact('ads'));
    }
}
