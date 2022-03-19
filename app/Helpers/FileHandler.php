<?php
namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileHandler
{
    private static $tempFolder = 'uploads/images/';

    private static $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    private static $videoExtensions = ['mp4', 'webm', 'ogg', 'ogv'];
    private static $attachmentExtensions = ['pdf'];

    public static function mediaUpload($media, $conf = '', $folder = '')
    {
        $folder = trim($folder, '/');
        $origName = $media->getClientOriginalName();
        $ext = $media->getClientOriginalExtension();
        $mime = $media->getMimeType();
        $origName = substr($origName, 0, strpos($origName, $ext) - 1);

        $path = Storage::putFile($folder, new File($media), 'public');

        if (self::isImage($ext) && $conf) {
            $thumbs = config('thumbs.'.$conf);
            if ($thumbs && is_array($thumbs)) {
                foreach ($thumbs as $thumb) {
                    self::generateThumb($path, $thumb, $folder);
                }
            }
        }
        if ($path) {
            return ['path' => $path, 'name' => $origName, 'ext' => $ext, 'mime_type' => $mime];
        }
        return false;
    }

    /**
     * Generate thumbnail function
     *
     * @param $path
     * @param $conf
     * @param $location
     * @return Void
     */
    private static function generateThumb($path, $conf, $location = '')
    {
        $location .= '/thumbs';
        $dim = explode('x', $conf['dimension']);
        $maintainRatio = $conf['maintain'];
        $image = \Image::make(Storage::get($path));
        if ($maintainRatio) {
            $image->resize($dim[0], $dim[1], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        } else {
            $image->fit($dim[0], $dim[1], null, 'top-left');
        }

        $thName = explode('/', $path);
        $thName = array_pop($thName);
        $thName = explode('.', $thName);
        $ext = array_pop($thName);

        $thName = implode('', $thName);
        $thName = $thName . $conf['postfix'] . '.' . $ext;

        $image->save(public_path(self::$tempFolder . $thName));
        $savedImageUri = $image->dirname.'/'.$image->basename;
        Storage::putFileAs($location, new File($savedImageUri), $thName, 'public');
        $image->destroy();
        @unlink($savedImageUri);
    }

    /**
     * Generate thumbnail function
     *
     * @param $mediaId
     * @param $thumbgroup
     * @return true | null
     */
    public static function deleteMediaFiles($mediaId, $thumbgroup = false)
    {
        if (!$mediaId) {
            return false;
        }
        $media = \App\Media::find($mediaId);
        if ($media) {
            if ($thumbgroup) {
                $group = config('thumbs.'.$thumbgroup);
                foreach ($group as $grp) {
                    $thumbFile = \App\Helpers\Thumb::getThumbName($media->path, $grp['postfix']);
                    if (Storage::exists($thumbFile)) {
                        Storage::delete($thumbFile);
                    }
                }
            }
            if (Storage::exists($media->path)) {
                Storage::delete($media->path);
            }
            $media->delete();
            return true;
        }
        return false;
    }

    public static function isImage($ext)
    {
        return in_array($ext, self::$imageExtensions);
    }

    public static function isVideo($ext)
    {
        return in_array($ext, self::$videoExtensions);
    }

    public static function isAttachment($ext)
    {
        return in_array($ext, self::$attachmentExtensions);
    }

    public static function getMediaType($ext)
    {
        if ( self::isImage($ext) ) {
            return 'photo';
        } elseif (self::isVideo($ext)) {
            return 'video';
        } elseif (self::isAttachment($ext)) {
            return 'attachment';
        } else {
            return 'text';
        }
    }

}
