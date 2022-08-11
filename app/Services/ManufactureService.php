<?php
namespace App\Services;

use App\Models\Manufacture;
use Illuminate\Support\Facades\Auth;
use App\Models\Manufactures;
use Exception;

class ManufactureService
{
    protected $manufactureModel;

    public function __construct(Manufacture $manufactureModel)
    {
        $this->manufactureModel = $manufactureModel;
    }

    public function create($data)
    {
        $manufacture = new Manufacture();
        $manufacture->ma_ncc          = $data['ma_ncc'] ?? '';
        $manufacture->ten_ncc         = $data['ten_ncc'] ?? '';
        $manufacture->dia_chi         = $data['dia_chi'] ?? '';
        $manufacture->email           = $data['email'] ?? '';
        try {
            $manufacture->save();
        } catch (Exception $e) {
            return false;
        }
        return $manufacture;
    }

    public function update($manufacture, $data)
    {
        $manufacture->ma_ncc          = $data['ma_ncc'] ?? '';
        $manufacture->ten_ncc         = $data['ten_ncc'] ?? '';
        $manufacture->dia_chi         = $data['dia_chi'] ?? '';
        $manufacture->email           = $data['email'] ?? '';
        try {
            $manufacture->save();
        } catch (Exception $e) {
            return false;
        }
        return $manufacture;
    }


    public function getDataIndex($key_search = null)
    {
        return $this->manufactureModel->getDataIndex($key_search);
    }
}
