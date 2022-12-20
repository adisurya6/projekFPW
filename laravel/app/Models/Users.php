<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [];
    protected $appends = ['role'];
    public function getRoleAttribute()
    {
        return 'user';
    }


    public function Jobs()
    {
        // Param 1. Sdata yg mau diambil itu ada di table apa
        // Param 2. melewati table pivot apa?
        // Param 3. kau punya apa untuk masuk ke pivot?
        // Param 4. lha table yg kamu rujuk dia dikenali sebagai apa di pivot?

        return $this->belongsToMany(Job::class, 'applications', 'user_id', 'Job_id');
    }
}
