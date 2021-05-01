<?php

namespace App\Repositories\Banner;

interface IBannerRepository {

    public function getBannerWithPaginate($record);

    public function getBannerActive();

    public function getBannerBySlug($slug);

    public function getBannerByTitle($title);
}
