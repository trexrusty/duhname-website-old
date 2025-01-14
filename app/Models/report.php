<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class report extends Model
{
    /** @use HasFactory<\Database\Factories\ReportFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'post_id', 'comment_id', 'reason'];
}
