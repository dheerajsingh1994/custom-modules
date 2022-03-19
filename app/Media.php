<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = [
        'name', 'path', 'mime', 'parent', 'mime_type'
    ];

    protected $hidden = ['pivot'];

    protected $table = 'medias';

    protected $appends = ['media_url', 'stream_url', 'thumb_url', 'type'];

    /**
    * Get media owner/user object.
    */
   /* public function user()
    {
        return $this->belongsTo('App\User');
    }*/

    public function getMediaUrlAttribute()
    {
        return Storage::exists($this->path) ? Storage::url($this->path) : null;
    }

    public function getThumbUrlAttribute()
    {
        return \App\Helpers\Thumb::getThumbnailUrl($this->path) ?: null;
    }

    public function getTypeAttribute()
    {
        return \App\Helpers\FileHandler::getMediaType($this->mime);
    }

    public function getStreamUrlAttribute()
    {
        return null;
    }

}
