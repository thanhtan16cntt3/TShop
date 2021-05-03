<?php

namespace App\Repositories\PostComment;

use App\Models\backend\Comment;
use App\Repositories\BaseRepository;

class PostCommentRepository extends BaseRepository implements IPostCommentRepository{
    public function getModel()
    {
        return Comment::class;
    }

    public function getAllWithAuthor(){
        return $this->model::with('author')->get();
    }

}