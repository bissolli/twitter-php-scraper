<?php

namespace Bissolli\TwitterScraper;

use Bissolli\TwitterScraper\Models\Account;
use Bissolli\TwitterScraper\Models\Tweet;
use Bissolli\TwitterScraper\Traits\HelpersTrait;
use Carbon\Carbon;
use PHPHtmlParser\Dom;

class Twitter extends TwitterAbstract
{
    use HelpersTrait;

    /**
     * Create a new Twitter instance
     *
     * @param string $username
     */
    public function __construct($username)
    {
        $this->setHandle($username);

        $dom = new Dom();
        $dom->load('https://twitter.com/'.$username);

        $this->setDomHtml($dom);

        $this->extractProfileCard();

        return $this;
    }

    /**
     * Extract basic data from user's account
     *
     * @return void
     */
    protected function extractProfileCard()
    {
        $profileCard = $this->domHtml->find('div.ProfileHeaderCard');
        $profileNav = $this->domHtml->find('div.ProfileNav');

        $account = Account::create([
            'name' => $this->sanitizeNodeText($profileCard->find('.ProfileHeaderCard-nameLink')[0]),
            'joined_at' => $profileCard->find('.ProfileHeaderCard-joinDateText')[0]->getAttribute('title'),
            'locale' => $this->sanitizeNodeText($profileCard->find('.ProfileHeaderCard-locationText')[0]),
            'website' => $this->sanitizeNodeAttr($profileCard->find('.ProfileHeaderCard-url a')[0]),
            'date_of_birth' => $this->sanitizeNodeText($profileCard->find('.ProfileHeaderCard-birthdateText span')[0]),
            'bio' => $this->sanitizeNodeText($profileCard->find('.ProfileHeaderCard-bio')[0]),
            'avatar_url' => $this->sanitizeNodeAttr($this->domHtml->find('img.ProfileAvatar-image')[0], 'src'),
            'cover_url' => $this->sanitizeNodeAttr($this->domHtml->find('div.ProfileCanopy-headerBg > img')[0], 'src'),
            'tweets_count' => $this->sanitizeNodeAttr($profileNav->find('.ProfileNav-item--tweets .ProfileNav-value')[0], 'data-count'),
            'following_count' => $this->sanitizeNodeAttr($profileNav->find('.ProfileNav-item--following .ProfileNav-value')[0], 'data-count'),
            'followers_count' => $this->sanitizeNodeAttr($profileNav->find('.ProfileNav-item--followers .ProfileNav-value')[0], 'data-count'),
            'favorites_count' => $this->sanitizeNodeAttr($profileNav->find('.ProfileNav-item--favorites .ProfileNav-value')[0], 'data-count'),
            'lists_count' => $this->sanitizeNodeText($profileNav->find('.ProfileNav-item--lists .ProfileNav-value')[0], 0),
            'is_verified' => count($this->domHtml->find('.ProfileHeaderCard-badges .Icon--verified')[0]) > 0,
        ]);

        $this->setProfile($account);
    }

    /**
     * Load last X reachable tweets from the user's account
     *
     * @return void
     */
    public function loadTweets()
    {
        $tweets = [];

        foreach($this->domHtml->find('li[data-item-type="tweet"] div.tweet') as $tweet) {
            array_push(
                $tweets,
                Tweet::create([
                    'id' => $tweet->{'data-tweet-id'},
                    'username' => $tweet->{'data-screen-name'},
                    'is_retweet' => count($tweet->find('.js-retweet-text')[0]) > 0,
                    'content' => $this->sanitizeNodeText($tweet->find('.tweet-text')[0]),
                    'created_at' => Carbon::createFromTimestampMs($this->sanitizeNodeAttr($tweet->find('.tweet-timestamp span')[0], 'data-time-ms')),
                    'replies_count' => $this->countAttr($tweet->find('.ProfileTweet-action--reply .ProfileTweet-actionCount'), 'data-tweet-stat-count'),
                    'retweets_count' => $this->countAttr($tweet->find('.ProfileTweet-action--retweet .ProfileTweet-actionCount'), 'data-tweet-stat-count'),
                    'favorites_count' => $this->countAttr($tweet->find('.ProfileTweet-action--favorite .ProfileTweet-actionCount'), 'data-tweet-stat-count'),
                ])
            );
        }

        $this->setTweets($tweets);
    }
}
