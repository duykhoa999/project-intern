<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Trademark;
use Exception;

class TrademarkService
{
    protected $trademarkModel;

    public function __construct(Trademark $trademarkModel)
    {
        $this->trademarkModel = $trademarkModel;
    }

    public function create($data)
    {
        $trademark = new Trademark();
        $trademark->ma_th         = $data['ma_th'] ?? '';
        $trademark->ten_th        = $data['ten_th'] ?? '';
        $trademark->slug         = $data['slug'] ?? '';
        $trademark->hinh_anh           = $data['hinh_anh'] ?? '';
        $trademark->mo_ta           = $data['mo_ta'] ?? '';
        try {
            $trademark->save();
        } catch (Exception $e) {
            return false;
        }
        return $trademark;
    }

    public function update($trademark, $data)
    {
        $trademark->ten_th        = $data['ten_th'] ?? '';
        $trademark->slug         = $data['slug'] ?? '';
        $trademark->hinh_anh           = $data['hinh_anh'] ?? '';
        $trademark->mo_ta           = $data['mo_ta'] ?? '';
        try {
            $trademark->save();
        } catch (Exception $e) {
            return false;
        }
        return $trademark;
    }
    public function delete($trademark, $id_user)
    {
        $trademark->del_flag     = config('define.del_flag.deleted');
        $trademark->created_by     = $id_user;
        try {
            $trademark->save();
        } catch (Exception $e) {
            return false;
        }
        return $trademark;
    }

    public function getDataIndex($key_search = null)
    {
        return $this->trademarkModel->getDataIndex($key_search);
    }
}
