<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    protected $table = 'failed_jobs';
}
