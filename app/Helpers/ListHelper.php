<?php

use App\Repositories\SiteManagement\SiteManagementRepository;
use Illuminate\Support\Facades\File;

/**
* This is a helper class to process,upload and remove images from different models
*/

class ListHelper
{
    /**
     * Random avatar for the model
     * @param \Illuminate\Database\Eloquent\Model
     */
    public static function randomAvatar()
    {
        if (!! count(self::getAvatarList())) {
            $avatars = self::getAvatarList();
            return $avatars[array_rand($avatars)];
        }

        return NULL;
    }

    /**
     * Get list of the generate avatar
     *
     * @return []
     */
    public static function getAvatarList()
    {
        $avatarDir = public_path('assets/img/avatar');
        if (File::isDirectory($avatarDir)) {
            $imgDirs = File::glob($avatarDir . '/*');
            $avatars  = [];
            foreach ($imgDirs as $imgPath) {
                $tempArr  = explode('/', $imgPath);
                $type     = array_pop($tempArr);
                $avatars[] = $type;
            }

            return $avatars;
        }

        return [];
    }

    /**
     * Site management
     */
    public static function siteManagement($field = null)
    {
        $siteManagement = (new SiteManagementRepository)->find(1);

        if ($siteManagement && $field) {
            return $siteManagement->$field;
        }

        return $siteManagement;
    }
}
