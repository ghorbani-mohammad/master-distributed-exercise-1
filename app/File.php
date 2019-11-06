<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $fillable = [
        'file_name', 'file_size', 'file_hash'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
