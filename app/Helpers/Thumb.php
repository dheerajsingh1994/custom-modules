<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Thumb
{
    public static function getThumbnailUrl($path, $thumb = 'post.th_200')
    {
        $thumb = explode('.', $thumb);
        $conf = config('thumbs.'.$thumb[0]);
        if (count($thumb) < 2) {
            return false;
        }
        $thName = self::getThumbName($path, $conf[$thumb[1]]['postfix']);
        return Storage::exists($thName) ? Storage::url($thName) : null;
    }

    public static function getThumbName($fullPath, $postfix)
    {
        if (!$fullPath || !$postfix) {
            return false;
        }
        $arr = explode('/', $fullPath);
        $thName = array_pop($arr);
        $ext = pathinfo($thName, PATHINFO_EXTENSION);
        $thName = substr($thName, 0, strpos($thName, $ext) - 1) . $postfix . '.' . $ext;
        $thName = implode('', $arr) . '/thumbs/' . $thName;
        return $thName;
    }

}
