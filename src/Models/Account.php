<?php

namespace Bissolli\TwitterScraper\Models;

class Account extends ModelAbstract implements \JsonSerializable
{
    /**
     * Name
     * @var string
     */
    protected $name = null;

    /**
     * Joined on Twitter at
     * @var string
     */
    protected $joinedAt = null;

    /**
     * Avatar url
     * @var string
     */
    protected $avatarUrl = null;

    /**
     * Cover url
     * @var string
     */
    protected $coverUrl = null;

    /**
     * Website url
     * @var string
     */
    protected $website = null;

    /**
     * Locale
     * @var string
     */
    protected $locale = null;

    /**
     * Bio filled by the user
     * @var string
     */
    protected $bio = null;

    /**
     * Number of users the user is following
     * @var integer
     */
    protected $followingCount = 0;

    /**
     * Number of followers
     * @var integer
     */
    protected $followersCount = 0;

    /**
     * Total number of tweets published by the user
     * @var integer
     */
    protected $tweetsCount = 0;

    /**
     * Total of favorites
     * @var integer
     */
    protected $favoritesCount = 0;

    /**
     * Total of lists
     * @var integer
     */
    protected $listsCount = 0;

    /**
     * Date of birth
     * @var integer
     */
    protected $dateOfBirth = null;

    /**
     * true if verified by Twitter
     * @var boolean
     */
    protected $isVerified = false;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @return string
     */
    public function getCoverUrl()
    {
        return $this->coverUrl;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @return int
     */
    public function getFollowingCount()
    {
        return $this->followingCount;
    }

    /**
     * @return int
     */
    public function getFollowersCount()
    {
        return $this->followersCount;
    }

    /**
     * @return int
     */
    public function getTweetsCount()
    {
        return $this->tweetsCount;
    }

    /**
     * @return int
     */
    public function getListsCount()
    {
        return $this->listsCount;
    }

    /**
     * @return int
     */
    public function getFavoritesCount()
    {
        return $this->favoritesCount;
    }

    /**
     * @return bool
     */
    public function getIsVerified()
    {
        return $this->isVerified;
    }

    /**
     * @return int
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @return string
     */
    public function getJoinedAt()
    {
        return $this->joinedAt;
    }

    /**
     * @param $value
     * @param $prop
     */
    public function initProperties($value, $prop)
    {
        switch ($prop) {
            case 'name':
                $this->name = $value;
                break;
            case 'joined_at':
                $this->joinedAt = $value;
                break;
            case 'avatar_url':
                $this->avatarUrl = $value;
                break;
            case 'cover_url':
                $this->coverUrl = $value;
                break;
            case 'website':
                $this->website = $value;
                break;
            case 'locale':
                $this->locale = $value;
                break;
            case 'bio':
                $this->bio = $value;
                break;
            case 'following_count':
                $this->followingCount = $value;
                break;
            case 'followers_count':
                $this->followersCount = $value;
                break;
            case 'tweets_count':
                $this->tweetsCount = $value;
                break;
            case 'favorites_count':
                $this->favoritesCount = $value;
                break;
            case 'lists_count':
                $this->listsCount = $value;
                break;
            case 'date_of_birth':
                $this->dateOfBirth = $value;
                break;
            case 'is_verified':
                $this->isVerified = (bool) $value;
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
                'name' => $this->getName(),
                'joined_at' => $this->getJoinedAt(),
                'avatar_url' => $this->getAvatarUrl(),
                'cover_url' => $this->getCoverUrl(),
                'website' => $this->getWebsite(),
                'locale' => $this->getLocale(),
                'bio' => $this->getBio(),
                'following_count' => $this->getFollowingCount(),
                'followers_count' => $this->getFollowersCount(),
                'tweets_count' => $this->getTweetsCount(),
                'favorites_count' => $this->getFavoritesCount(),
                'lists_count' => $this->getListsCount(),
                'date_of_birth' => $this->getDateOfBirth(),
                'is_verified' => $this->getIsVerified(),
            ];
    }
}
