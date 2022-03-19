<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Document extends Model
{
    // use SoftDeletes;
    protected $fillable = ['user_id','description', 'status' ];

    // protected $dates = ['deleted_at'];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function attachments(){
        return $this->hasMany(DocumentAttachment::class);
    }
}
