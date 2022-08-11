<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AppController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $controller_active;
    protected $validator;
    const EXT_IMAGE = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'psd', 'PSD'];

    public function __construct()
    {
        $this->controller_active = '';
        $this->validator = Validator::make(['_tmp' => null], ['_tmp' => 'required']);
    }

    public function pushMessage($key, $value)
    {
        $this->validator->errors()->add($key, $value);
    }

    public function fileExtImage($ext)
    {
        if(in_array($ext, self::EXT_IMAGE))
            return true;
        return false;
    }

    // protected function setConfig()
    // {
    //     $configs = Config::where(['del_flag' => config('define.del_flag.undelete'), 'active' => config('define.active.active')])->get();
    //     $res = [];
    //     foreach($configs as $conf)
    //     {
    //         $res[$conf->property] = $conf;
    //     }

    //     $this->set('config_global', $res);
    // }

    // protected function setImageBanner()
    // {
    //     $images = Image::where(['del_flag' => config('define.del_flag.undelete'), 'active' => config('define.active.active')])->get();
    //     $res = [];
    //     foreach($images as $image)
    //     {
    //         $res[$image->property] = $image;
    //     }

    //     if(isset($res['logo']))
    //     {
    //         $this->set('meta_keyword', $res['logo']->title);
    //         $this->set('meta_description', $res['logo']->description);
    //         $this->set('title', $res['logo']->title);
    //     }
    //     else
    //     {
    //         $this->set('meta_keyword', '');
    //         $this->set('meta_description', '');
    //         $this->set('title', '');
    //     }

    //     $this->set('image_global', $res);
    // }

    // protected function setCategory() {
    //     $categories = Category::where('del_flag', config('define.del_flag.undelete'))
    //                         ->where('active', config('define.active.active'))->get();

    //     $this->set('categories', $categories);
    // }

    protected function set($key, $value)
    {
        View::share($key, $value);
    }
}
