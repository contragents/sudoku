<?php

use classes\Config;
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

    const SITE_IMG_ID_FIELD = 'site_img_id';
    const SITE_FIELD = 'site';
    const NOT_LOADED_FIELD = 'queued'; // "1" if image not loaded, "0" otherwise
    const MINI_IMG_URL_FIELD = 'mini_url'; // URL within site begins with "/"
    const FULL_IMG_URL_FIELD = 'full_url'; // URL within site begins with "/"

    public ?int $_site_img_id = null;
    public ?string $_site = null;
    public ?string $_mini_url = null;
    public ?string $_full_url = null;
    public ?bool $_queued = null;

    /**
     * Provides ABSOLUTE link to default avatar by $commonId
     * @param int $commonId
     * @return string
     */
    public static function getDefaultAvatar(int $commonId): string
    {
        $maxImgId = 34768;
        $imgId = $commonId % $maxImgId;

        $siteField = Config::DOMAIN() === Config::DOMAIN_SUDOKU_BOX
            ? "'https://" . Config::DOMAIN_SUDOKU_BOX . "'"
            : self::SITE_FIELD;

        $miniUrl = self::MINI_IMG_URL_FIELD;

        $query = ORM::select(["concat($siteField,$miniUrl)"], self::TABLE_DEFAULT_URL)
            . ORM::where(self::SITE_IMG_ID_FIELD, '>=', $imgId, true)
            . ORM::andNot(self::SITE_IMG_ID_FIELD, 'in', '(' . implode(', ', self::BLOCKED_AVATAR_IDS) . ')', true)
            . ORM::andNot(self::NOT_LOADED_FIELD, '=', 1, true)
            . ORM::limit(1);

        return DB::queryValue($query) ?: '';
    }
}