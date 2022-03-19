<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentAttachment extends Model
{
    protected $fillable = ['name','slug','user_id','status','media_id', 'document_id'];
    protected $table = 'document_attachment';

    protected $appends = ['image', 'image_thumb_60'];
    protected $hidden = ['pivot', 'media'];
   
    /**
    * Get media object.
    */
    public function media() {
        return $this->belongsTo(Media::class);
    }

    public function document() {
        return $this->belongsTo(Document::class);
    }

    public function getImageAttribute() {
        return $this->media ? $this->media->media_url : null;
    }
    public function getImageThumb60Attribute() {   
        $emptyimage = \URL::to('/no.png');
        return $this->media ? \App\Helpers\Thumb::getThumbnailUrl($this->media->path, 'attachment.th_60') : $emptyimage;
    }
   
    public function user() {
        return $this->belongsTo(User::class);
    }


   
}
