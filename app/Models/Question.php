<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['test_set_id', 'title'];

    public function testSet()
    {
        return $this->belongsTo(TestSet::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}