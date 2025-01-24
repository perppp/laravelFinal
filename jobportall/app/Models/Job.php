<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',        // Refers to the employer posting the job
        'is_public',
        'category_id',    // Assuming a single category is assigned per job
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relationship with User/Employer
    public function employer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Applications
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
