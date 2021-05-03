<?php
namespace App\Repositories\Tag;

use App\Models\backend\Tag;
use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements ITagRepository{
    public function getModel()
    {
        return Tag::class;
    }

    public function getTagWithPaginate($record){
        return $this->model::OrderBy('id', 'DESC')->paginate($record);
    }

    public function getPostTagBySlug($slug){
        return $this->model::where('slug', $slug)->OrderBy('id', 'DESC')->get();
    }

}
