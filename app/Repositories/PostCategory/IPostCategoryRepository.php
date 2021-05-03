<?php
namespace App\Repositories\PostCategory;

interface IPostCategoryRepository{
    public function getPostCategoryWithPaginate($record);
    public function getPostCategoryBySlug($slug);
}
