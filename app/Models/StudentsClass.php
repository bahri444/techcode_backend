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
    protected $table = 'students_class';
    protected $fillable = [
        'user_uuid',
        'class_uuid',
        'date_checkout_class',
        'payment_state',
        'created_at',
        'updated_at'
    ];
    protected $guarded = [];

    public function joinToClass()
    {
        return $this->hasMany(Classes::class, 'class_uuid', 'class_uuid');
    }
    public function joinToUsers()
    {
        return $this->hasMany(User::class, 'user_uuid', 'user_uuid');
    }
    public function joinToClassWithModul()
    {
        return $this->hasMany(Moduls::class, 'class_uuid', 'class_uuid');
    }
    public function joinToProfessionWithClass()
    {
        return $this->hasMany(Classes::class, 'profession_uuid', 'profession_uuid');
    }
}
