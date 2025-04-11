<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'youtube_url', 'test_set_id'];
    
    public function testSet()
    {
        return $this->belongsTo(TestSet::class);
    }
}
