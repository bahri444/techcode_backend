<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moduls extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'modul_uuid';
    protected $table = 'moduls';
    protected $fillable = [
        'modul_categories_uuid',
        'class_uuid',
        'modul_title',
        'modul_files',
        'modul_to',
        'learn_state',
        'created_at',
        'updated_at',
    ];
    protected $guarded = [];
}
