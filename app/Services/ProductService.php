<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Exception;

class ProductService
{
    protected $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function create($data)
    {
        $product = new Product();
        $product->ma_dr          = $data['ma_dr'] ?? '';
        $product->ten_dr        = $data['ten_dr'] ?? '';
        $product->slug         = $data['slug'] ?? '';
        $product->gia           = $data['gia'] ?? '';
        $product->mo_ta           = $data['mo_ta'] ?? '';
        $product->noi_dung_dr           = $data['noi_dung'] ?? '';
        $product->hinh_anh           = $data['hinh_anh'] ?? '';
        $product->check_sp_moi           = $data['check_sp_moi'] ?? '';
        $product->sl_ton           = $data['sl_ton'] ?? '';
        $product->ma_lr           = $data['ma_lr'] ?? '';
        $product->check_sp_moi           = 0;
        $product->ma_th            = $data['ma_th'] ?? '';
        $product->ma_ncc            = $data['ma_ncc'] ?? '';
        try {
            $product->save();
        } catch (Exception $e) {
            return false;
        }
        return $product;
    }

    public function update($product, $data)
    {
        $product->ma_dr          = $data['ma_dr'] ?? '';
        $product->ten_dr        = $data['ten_dr'] ?? '';
        $product->slug         = $data['slug'] ?? '';
        $product->gia           = $data['gia'] ?? '';
        $product->mo_ta           = $data['mo_ta'] ?? '';
        $product->noi_dung_dr           = $data['noi_dung'] ?? '';
        $product->hinh_anh           = $data['hinh_anh'] ?? '';
        $product->check_sp_moi           = $data['check_sp_moi'] ?? '';
        $product->sl_ton           = $data['sl_ton'] ?? '';
        $product->ma_lr           = $data['ma_lr'] ?? '';
        $product->ma_th            = $data['ma_th'] ?? '';
        $product->check_sp_moi           = 1;
        $product->ma_ncc            = $data['ma_ncc'] ?? '';
        try {
            $product->save();
        } catch (Exception $e) {
            return false;
        }
        return $product;
    }


    public function getDataIndex($key_search = null, $arr = null)
    {
        return $this->productModel->getDataIndex($key_search, $arr);
    }
}
