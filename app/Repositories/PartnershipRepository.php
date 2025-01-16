<?php

namespace App\Repositories;

use App\Models\Partnership;

class PartnershipRepository extends BaseRepository
{
    public function __construct(Partnership $model)
    {
        parent::__construct($model);
    }
}