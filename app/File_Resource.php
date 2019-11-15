<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File_Resource extends Model
{
    //
    protected $fillable = [
        'file_name', 'file_size', 'file_hash', 'file_dir'
    ];

    protected $table = 'files_resource';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file_partitions()
    {
        return $this->hasMany(File_Partition::class);
    }
}
