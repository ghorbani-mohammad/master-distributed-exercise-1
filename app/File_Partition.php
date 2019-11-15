<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File_Partition extends Model
{
    //
    protected $table = 'file_partitions';
    protected $fillable = [
        'file_id', 'partition', 'storage', 'size', 'dir', 'file__resource_id', 'hash'
    ];
    public function File()
    {
        return $this->belongsTo(File::class);
    }
}
