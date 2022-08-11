<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Exception;

class CategoryService
{
    protected $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function create($data)
    {
        $category = new Category();
        $category->ma_lr         = $data['ma_lr'] ?? '';
        $category->ten_lr         = $data['ten_lr'] ?? '';
        $category->slug         = $data['slug'] ?? '';
        try {
            $category->save();
        } catch (Exception $e) {
            return false;
        }
        return $category;
    }

    public function update($category, $data)
    {
        $category->ten_lr         = $data['ten_lr'] ?? '';
        $category->slug         = $data['slug'] ?? '';
        try {
            $category->save();
        } catch (Exception $e) {
            return false;
        }
        return $category;
    }

    public function getDataIndex($key_search = null)
    {
        return $this->categoryModel->getDataIndex($key_search);
    }
}
