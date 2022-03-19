<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['name','slug','user_id','status','media_id', 'comment_id'];

    protected $appends = ['image', 'image_thumb_60'];
    protected $hidden = ['pivot', 'media'];
    /**
   
    /**
    * Get media object.
    */
    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    public function getImageAttribute()
    {
        return $this->media ? $this->media->media_url : null;
    }
    public function getImageThumb60Attribute()
    {   
         $emptyimage = \URL::to('/no.png');
        return $this->media ? \App\Helpers\Thumb::getThumbnailUrl($this->media->path, 'attachment.th_60') : $emptyimage;
    }
   
   public function user()
    {
        return $this->belongsTo('App\User');
    }


   
}
