<?php

namespace App\Repositories\SiteManagement;

use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class SiteManagementRepository extends EloquentRepository implements SiteManagementRepositoryInterface
{
    public function model()
    {
        return \App\Models\SiteManagement::class;
    }
}
