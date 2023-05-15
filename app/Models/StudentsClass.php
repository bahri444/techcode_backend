<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsClass extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'student_class_uuid';
    protected $table = 'student_class';
    protected $fillable = [
        'user_uuid',
        'class_uuid',
        'date_checkout_class',
        'price_state',
        'created_at',
        'updated_at'
    ];
    protected $guarded = [];
}
