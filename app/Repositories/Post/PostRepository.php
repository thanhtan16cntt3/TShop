<?php

namespace App\Repositories\Post;

use App\Models\backend\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements IPostRepository{
    public function getModel()
    {
        return Post::class;
    }

    public function getPostWithTagsPaginate($record){
        // return $this->model::with('tags')->OrderBy('id', 'DESC')->paginate($record)->get();
        return $this->model::with('tags')->OrderBy('id', 'DESC')->get();
    }

    public function findWithTags($id){
        return $this->model::with('tags')->find($id);
    }
}
