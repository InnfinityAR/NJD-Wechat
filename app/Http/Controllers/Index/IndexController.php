<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class IndexController extends CommonController
{
    public function index() {
        return view("index.index.index");
    }
}
