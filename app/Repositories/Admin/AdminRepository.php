<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;
use App\User;

class AdminRepository extends BaseRepository implements IAdminRepository{

    public function getModel()
    {
        return User::class;
    }

}
