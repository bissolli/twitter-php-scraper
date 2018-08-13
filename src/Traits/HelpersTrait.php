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

    protected function countAttr($node, $attr = 'title', $default = null)
    {
        $count = $this->sanitizeNodeAttr($node[0], $attr, $default);

        if ($count == 0)
            return $node->find('.ProfileTweet-actionCountForPresentation')->text;

        return $count;
    }
}
