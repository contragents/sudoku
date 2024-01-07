<?php

use classes\Cache;
use classes\Config;
use classes\Filters;

?>
<form>
    <input type="hidden" name="action" value="index"/>
    Номер Тизера <input type="number" name="teaser_id" value="<?= PostbackController::$Request['teaser_id'] ?? ''; ?>"/>
    <br/>
    Номер РК <input type="number" name="advc_id" value="<?= PostbackController::$Request['advc_id'] ?? ''; ?>"/> <br/>

    <button type="submit">Запросить</button>
</form>
<form>
    <input type="hidden" name="action" value="index"/><input type="hidden" name="active_teasers" value="yes"/><button type="submit">Активные Тизеры</button>
</form>
<form>
    <input type="hidden" name="action" value="index"/><input type="hidden" name="clear_cache" value="yes"/><button type="submit">Очистить кеш APCu</button>
</form>
<form <?= Config::isDebug() ? 'target="_blank"' : ''?>>
    <input type="hidden" name="action" value="index"/><input type="hidden" name="enable_logging" value="yes"/><?php
    if (Config::isDebug()) {
        ?><button type = "submit" > Вывести логи </button ><?php
    } else {
        ?><button type = "submit" > Включить логгинг на 10 мин </button ><?php
    }
    ?>
</form>
<form>
    <input type="hidden" name="action" value="index"/>
    <input type="hidden" name="set_filters" value="1"/>
    Активные фильтры в аукционе:<br />
    <?php
    foreach (Filters::FILTERS_SETS as $set) {
        ?>
        <?= Filters::FILTERS_PROMPT[$set] ?>
        <input type="checkbox" name="<?= $set ?>" value="<?= Cache::hget(Filters::FILTER_SET_PREFIX, $set) ?>" <?= Cache::hget(Filters::FILTER_SET_PREFIX, $set) ? "checked" : '' ?> />
        <?php
    }
    ?>
    <br/>
    <button type="submit">Поменять фильтры</button>
</form>