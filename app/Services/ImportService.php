<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Import;
use Exception;

class ImportService
{
    protected $importModel;

    public function __construct(Import $importModel)
    {
        $this->importModel = $importModel;
    }

    public function create($data)
    {
        $order = Import::create($data);
        try {
            $order->save();
        } catch (Exception $e) {
            return false;
        }
        return $order;
    }

    public function update($import, $data)
    {
        try {
            $import->update($data);
        } catch (Exception $e) {
            return false;
        }
        return $import;
    }

    // public function getDataIndex($key_search = null)
    // {
    //     return $this->importModel->getDataIndex($key_search);
    // }
}
