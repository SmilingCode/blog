<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['content'];

    // one twitter belong to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
