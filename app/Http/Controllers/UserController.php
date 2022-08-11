<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Slider;

use App\Models\Products;
use App\Models\OrderDetails;
use Carbon\Carbon;
use App\CatePost;
use App\Models\Cart_details;
use App\Models\Carts;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }
}
