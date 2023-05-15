<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industries extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'industry_uuid';
    protected $table = 'industries';
    protected $fillable = [
        'industry_name',
        'industy_logo',
        'vision',
        'mision',
        'objective',
        'social_media',
        'created_at',
        'updated_a'
    ];
    protected $guarded = [];
}
