<?php

namespace Bissolli\TwitterScraper\Models;

class Tweet extends ModelAbstract implements \JsonSerializable
{
    /**
     * Id
     * @var string
     */
    protected $id = null;

    /**
     * Username
     * @var string
     */
    protected $username = null;

    /**
     * true if is re-tweet
     * @var string
     */
    protected $isRetweet = false;

    /**
     * Content of the tweet
     * @var string
     */
    protected $content = null;

    /**
     * Creation time
     * @var string
     */
    protected $createdAt = null;

    /**
     * Number of replies
     * @var string
     */
    protected $repliesCount = 0;

    /**
     * Number of retweets
     * @var integer
     */
    protected $retweetsCount = 0;

    /**
     * Total of favorites
     * @var integer
     */
    protected $favoritesCount = 0;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getisRetweet()
    {
        return $this->isRetweet;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getRepliesCount()
    {
        return $this->repliesCount;
    }

    /**
     * @return int
     */
    public function getRetweetsCount()
    {
        return $this->retweetsCount;
    }

    /**
     * @return int
     */
    public function getFavoritesCount()
    {
        return $this->favoritesCount;
    }

    /**
     * @param $value
     * @param $prop
     */
    public function initProperties($value, $prop)
    {
        switch ($prop) {
            case 'id':
                $this->id = $value;
                break;
            case 'username':
                $this->username = $value;
                break;
            case 'is_retweet':
                $this->isRetweet = (bool) $value;
                break;
            case 'content':
                $this->content = $value;
                break;
            case 'created_at':
                $this->createdAt = $value;
                break;
            case 'replies_count':
                $this->repliesCount = $value;
                break;
            case 'retweets_count':
                $this->retweetsCount = $value;
                break;
            case 'favorites_count':
                $this->favoritesCount = $value;
                break;
        }
    }

    /**
     * Implements JsonSerializable
     *
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return
        [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'is_retweet' => $this->getisRetweet(),
            'content' => $this->getContent(),
            'created_at' => $this->getCreatedAt(),
            'replies_count' => $this->getRepliesCount(),
            'retweets_count' => $this->getRetweetsCount(),
            'favorites_count' => $this->getFavoritesCount()
        ];
    }
}
