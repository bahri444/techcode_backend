<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actifity extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'actifity_uuid';
    protected $table = 'actifity';
    protected $fillable = ['actifity_categories_uuid', 'actifity_name', 'actifity_foto', 'description', 'place_actifity', 'start_date', 'end_date', 'actifity_status', 'created_at', 'updated_id'];
    protected $guarded = [];

    public function ToCategoriesActifity()
    {
        return $this->hasOne(ActifityCategories::class, 'actifity_categories_uuid', 'actifity_categories_uuid');
    }
}
