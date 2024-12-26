<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    

    use HasFactory;

    protected $fillable = [
        'company_id',
    'job_title', 
        'job_description',
        'required_skills',
        'education_experience',
        'posted_date',
        'location',
        'vacancy',
        'job_nature',
        'salary',
        'application_date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    protected $dates = [
        'posted_date',
        'application_date',
    ];
    public function applications()
{
    return $this->hasMany(JobApplication::class);
}

}
