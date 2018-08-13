<?php

namespace Bissolli\TwitterScraper;

use stdClass;

abstract class TwitterAbstract
{
    /**
     * Twitter account handle
     *
     * @var string
     */
    protected $handle;

    /**
     * Parsed HTML from the Twitter account
     *
     * @var \PHPHtmlParser\Dom
     */
    protected $domHtml;

    /**
     * Twitter data profile
     *
     * @var stdClass
     */
    protected $profile;

    /**
     * List of tweets found
     *
     * @var stdClass
     */
    protected $tweets = [];

    /**
     * @return stdClass
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @return stdClass
     */
    public function getTweets()
    {
        return $this->tweets;
    }

    /**
     * @param $handle
     */
    protected function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @param $domHtml
     */
    protected function setDomHtml($domHtml)
    {
        $this->domHtml = $domHtml;
    }

    /**
     * @param $profile
     */
    protected function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * @param $tweets
     */
    protected function setTweets($tweets)
    {
        $this->tweets = $tweets;
    }

    /**
     * Load profile data from the Twitter account
     *
     * @return void
     */
    abstract protected function extractProfileCard();
}
