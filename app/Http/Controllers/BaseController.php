<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    /**
     * Get the Base view.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('base');
    }
}
