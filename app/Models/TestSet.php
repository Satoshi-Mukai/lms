<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSet extends Model
{
    protected $fillable = ['year', 'name'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
