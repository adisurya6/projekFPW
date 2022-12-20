<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jobs';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [];

    public function Company()
    {
        // param 1 adalah classnya
        // param 2 adalah foreign keynya
        // param 3 adalah local

        return $this->belongsTo(Company::class, "company_id", "id");
    }

    public function Users()
    {
        // Param 1. Sdata yg mau diambil itu ada di table apa
        // Param 2. melewati table pivot apa?
        // Param 3. kau punya apa untuk masuk ke pivot?
        // Param 4. lha table yg kamu rujuk dia dikenali sebagai apa di pivot?

        return $this->belongsToMany(Users::class, 'applications', 'Job_id', 'user_id');
    }
}
