<?php
namespace App\Repositories\Tag;

interface ITagRepository{
    public function getTagWithPaginate($record);
    public function getPostTagBySlug($slug);
}
