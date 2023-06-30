<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'class_uuid';
    protected $table = 'class';
    protected $fillable = [
        'class_uuid',
        'profession_uuid',
        'class_name',
        'price_class',
        'class_duration',
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];
    protected $guarded = [];
    public function joinToProfession()
    {
        return $this->hasMany(Professions::class, 'profession_uuid', 'profession_uuid');
    }
}
