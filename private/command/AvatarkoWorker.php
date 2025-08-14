<?php

use classes\Cache;
use classes\Command;

include_once __DIR__ . '/../../autoload.php';

class AvatarkoWorker extends Command
{
    const LAST_AVATAR_LOADED_ID_KEY = 'sudoku.avatarko_last_id';

    public function run()
    {
        while (!(self::timeToEndOfExecution() < self::DEFAULT_TIME_TO_LIVE)) {
            $currentId = self::getLastId() ?: AvatarModel::getFirstID();
            if (!$currentId && $currentId !== 0) {
                exit;
            }

            $avatarModel = AvatarModel::getOneO($currentId);
            self::saveLastId(AvatarModel::getOneNextO($currentId)->_id ?? 0);

            if ($avatarModel->_queued) {
                continue;
            }

            print $avatarModel->_mini_url . PHP_EOL;

            $fileData = @file_get_contents($avatarModel->_site . $avatarModel->_mini_url);
            if ($fileData) {
                try {
                    @mkdir(__DIR__ . '/../..' . dirname($avatarModel->_mini_url) . '/', 0777, true);
                    if (file_put_contents(__DIR__ . '/../..' . $avatarModel->_mini_url, $fileData)) {
                        sleep(1);

                        continue;
                    } else {
                        throw new Exception('file_put_contents error');
                    }
                } catch (Throwable $e) {
                    print 'file save failed' . PHP_EOL;

                    $avatarModel->_queued = true;
                    $avatarModel->save();
                    sleep(1);

                    continue;
                }
            } else {
                print 'file get failed' . PHP_EOL;

                $avatarModel->_queued = true;
                $avatarModel->save();
                sleep(1);

                continue;
            }

            break;
        }
    }

    private static function saveLastId(int $id)
    {
        Cache::set(self::LAST_AVATAR_LOADED_ID_KEY, $id);
    }

    private static function getLastId(): ?int
    {
        return Cache::get(self::LAST_AVATAR_LOADED_ID_KEY) ?: null;
    }
}

(new AvatarkoWorker(__FILE__))->run();