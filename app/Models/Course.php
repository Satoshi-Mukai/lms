<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'year',
        'test_set_id',
        'pdf_filename',
    ];
    
    public function testSet()
    {
        return $this->belongsTo(TestSet::class);
    }
}
