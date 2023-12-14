<?php

namespace RandomAds;

class Listener
{
    public static function rebuildAds(\XF\Pub\App $app) {

        self::enableOnlyOneAdForPosition();
        /** @var \XF\Repository\Advertising $repo */
        $repo = \XF::repository('XF:Advertising');
        $repo->writeAdsTemplate();
    }

    private static function enableOnlyOneAdForPosition()
    {
        \XF::db()->query("UPDATE xf_advertising
SET active = 0
WHERE position_id='container_breadcrumb_top_above'
");
        \XF::db()->query("UPDATE xf_advertising
SET active = 1
WHERE position_id='container_breadcrumb_top_above'
ORDER BY RAND()
LIMIT 1");
    }

}