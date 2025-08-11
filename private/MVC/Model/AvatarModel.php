<?php

use classes\DB;
use classes\ORM;


/**
 * Class AvatarModel
 * @property int $_id
 * @property int $_site_img_id
 * @property string $_site
 * @property string $_mini_url
 * @property string $_full_url
 * @property bool $_queued 1 - file not found, 0 - OK
 */
class AvatarModel extends BaseModel
{
    const TABLE_DEFAULT_URL = 'avatar_urls';
    const TABLE_NAME = 'avatar_urls';
    const BLOCKED_AVATAR_IDS = [
        2160
    ];

    public ?int $_site_img_id = null;
    public ?string $_site = null;
    public ?string $_mini_url = null;
    public ?string $_full_url = null;
    public ?bool $_queued = null;

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