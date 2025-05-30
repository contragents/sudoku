<?php

use classes\DB;
use classes\ORM;

class AvatarModel extends BaseModel
{
    const TABLE_DEFAULT_URL = 'avatar_urls';
    const BLOCKED_AVATAR_IDS = [
        2160
    ];

    public static function getDefaultAvatar(int $commonId): string
    {
        $maxImgId = 34768;
        $imgId = $commonId % $maxImgId;

        $query = ORM::select(['concat(site,mini_url)'], self::TABLE_DEFAULT_URL)
            . ORM::where('site_img_id', '>=', $imgId, true)
            . ORM::andNot('site_img_id', 'in', '(' . implode(', ', self::BLOCKED_AVATAR_IDS) . ')', true)
            . ORM::limit(1);

        return DB::queryValue($query) ?: '';
    }
}