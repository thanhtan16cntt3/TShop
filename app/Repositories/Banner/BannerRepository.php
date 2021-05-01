<?php

namespace App\Repositories\Banner;

use App\Models\backend\Banner;
use App\Repositories\BaseRepository;

class BannerRepository extends BaseRepository implements IBannerRepository{
    public function getModel(){
        return Banner::class;
    }

    public function getBannerWithPaginate($record){
        return $this->model::OrderBy('id', 'DESC')->paginate($record);
    }

    public function getBannerActive(){
        return $this->model::where('status', 'active')->get();
    }

    public function getBannerBySlug($slug){
        return $this->model::where('slug', $slug)->get();
    }

    public function getBannerByTitle($title){
        return $this->model::where('title', $title)->get();
    }
}
