<?php

namespace App\Models;

class Designation extends BaseModel
{

    protected $fillable = [];
    protected $table = 'designation';
    protected $guarded = ['id'];

    protected function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }
}
