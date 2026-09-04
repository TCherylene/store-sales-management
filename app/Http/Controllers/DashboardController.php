<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public string $folder_path = 'pages.dashboard';
    public function index()
    {
        return view($this->folder_path . ".index");
    }
}
