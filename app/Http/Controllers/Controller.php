<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

abstract class Controller
{
    protected int $perPage;
    public string $folder_path = "";
    public function __construct(Request $request)
    {
        $this->perPage = $request->integer(
            'per_page',
            env('APP_PAGE_SIZE', 10)
        );
    }

    public function buildPage($name)
    {
        return  "pages.{$this->folder_path}.$name";
    }
}
