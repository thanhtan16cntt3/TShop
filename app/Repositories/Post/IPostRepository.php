<?php

namespace App\Repositories\Post;

interface IPostRepository{
    public function getPostWithTagsPaginate($record);
    public function findWithTags($id);
}
