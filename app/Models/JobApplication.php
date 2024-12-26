<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'cv_path',
        'status',
    ];
    public function job()
{
    return $this->belongsTo(Job::class);
}
 // Define the relationship to the User model
 public function user()
 {
     return $this->belongsTo(User::class);
 }
}
