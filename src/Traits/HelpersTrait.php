<?php

namespace Bissolli\TwitterScraper\Traits;

trait HelpersTrait
{
    protected function sanitizeNodeText($node, $default = null)
    {
        $response = $default;

        if ($node)
            $response = trim($node->text);

        return (is_null($response) || empty($response)) ? $default : trim($response);
    }

    protected function sanitizeNodeAttr($node, $attr = 'title', $default = null)
    {
        $response = $default;

        if ($node)
            $response = trim($node->getAttribute($attr));

        return (is_null($response) || empty($response)) ? $default : trim($response);
    }

    protected function countAttr($node, $attr = 'title', $default = 0)
    {
        if (!isset($node[0]->getAttributes()['data-tweet-stat-count']))
            return $node->find('.ProfileTweet-actionCountForPresentation')->text;

        $count = $this->sanitizeNodeAttr($node[0], $attr, $default);

        return $count;
    }
}
