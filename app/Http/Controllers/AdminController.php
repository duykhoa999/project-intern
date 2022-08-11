<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class AdminController extends AppController
{
    public function __construct()
	{
		parent::__construct();
	}

    public function index() {
        View::share('controller', config('define.controller.admin.dashboard'));
        return view('admin.index');
    }
}
