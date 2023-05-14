<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ActifityCategories extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'actifity_categories';
    protected $primaryKey = 'actifity_categories_uuid';
    protected $fillable = ['actifity_categories_name'];
    protected $guarded = [];
}
