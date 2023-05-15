<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulCategories extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'modul_categories_uuid';
    protected $table = 'modul_categories';
    protected $fillable = [
        'categories_name',
        'created_at',
        'updated_at'
    ];
    protected $guarded = [];
}
