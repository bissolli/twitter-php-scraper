<?php

namespace Bissolli\TwitterScraper\Models;

interface ModelInterface
{
    /**
     * @param $value
     * @param $prop
     */
    public function initProperties($value, $prop);
}
