<?php

use classes\DB;
use classes\ORM;

class DictModel extends BaseModel
{
    const TABLE_NAME = 'dict';
    const ID_FIELD = 'id';
    const FIND_WORDS_LIMIT = 20;
    const REPLACE = ['*' => '.*', '?' => '.', 'е' => '[её]', 'Е' => '[её]'];
    const QUERY_ERROR_MSG = 'Ошибка в запросе. Принимаются только буквы (А-Я, A-Z) и символы "*" (любые буквы) и "?" (ОДНА любая буква)';

    public static function findWords(string $pattern, int $numWords = self::FIND_WORDS_LIMIT): array
    {
        // удаляем пробелы, которые вставляет клавиатура мобил
        $pattern = str_replace(' ', '', $pattern);

        if (preg_match('/[^a-zA-ZА-Яа-яЁёЫыРрТтУуФфХхЦцЧчШшЩщЪъЬьЭэЮю*?\[\]]/', $pattern)) {
            return [['slovo' => self::QUERY_ERROR_MSG]];
        }

        $pattern = '^' . str_replace(array_keys(self::REPLACE), self::REPLACE, $pattern) . '$';

        $query = ORM::select(['slovo'], self::TABLE_NAME)
            . ORM::where('slovo', 'REGEXP', "\"$pattern\"", true)
            . ORM::andWhere(self::IS_DELETED_FIELD, '=', 0, true)
            . ORM::orderBy('rand()')
            . ORM::limit($numWords);

        return DB::queryArray($query) ?: [['slovo' => 'Слова не найдены']];
    }
}