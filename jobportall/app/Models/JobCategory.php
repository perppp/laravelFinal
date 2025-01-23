<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class JobCategory extends Pivot
{
    protected $table = 'job_categories';
}