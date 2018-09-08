<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{

    /**
     * 毎回権限チェックを行う
     *
     * RootController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Rootページ
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('root', []);
    }
}
