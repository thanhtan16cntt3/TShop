<?php
namespace App\Repositories\PostCategory;

use App\Models\backend\PostCategory;
use App\Repositories\BaseRepository;

class PostCategoryRepository extends BaseRepository implements IPostCategoryRepository{
    public function getModel()
    {
        return PostCategory::class;
    }

    public function getPostCategoryWithPaginate($record){
        return $this->model::OrderBy('id', 'DESC')->paginate($record);
    }

    public function getPostCategoryBySlug($slug){
        return $this->model::where('slug', $slug)->OrderBy('id', 'DESC')->get();
    }

}
