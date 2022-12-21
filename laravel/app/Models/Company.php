<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'companies';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [];
    public function getRoleAttribute()
    {
        return 'company';
    }

    public function Job()
    {
        // param 1 adalah classnya
        // param 2 adalah foreign keynya
        // param 3 adalah local

        return $this->hasMany(Job::class, "company_id", "id");
    }

    public function Transaction()
    {
        return $this->hasMany(Transaction::class, "company_id", "id");
    }
}
