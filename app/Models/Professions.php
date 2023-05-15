<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professions extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'profession_uuid';
    protected $table = 'professions';
    protected $fillable = [
        'profession_name',
        'created_at',
        'updated_at'
    ];
    protected $guarded = [];
}
