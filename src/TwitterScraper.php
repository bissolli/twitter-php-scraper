<?php

namespace Bissolli\TwitterScraper;

use Sunra\PhpSimple\HtmlDomParser;

class TwitterScraper
{
    public function getAccount($username)
    {
        $tweet_results = [];

        $html = HtmlDomParser::file_get_html('https://twitter.com/'.$username);

        if($html){
            foreach($html->find('div[class=tweet]') as $tweet){
                $tweet_result = new \stdClass();

                //tweet ID
                $property = 'data-item-id';
                $tweet_result->id = $tweet->$property;

                //username of tweet
                $property = 'data-screen-name';
                $tweet_result->username = $tweet->$property;

                //is a retweet?
                $tweet_is_retweet = false;
                foreach($tweet->find('div[class=context]') as $tweet_context){
                    if( strlen($tweet_context->innertext) > 19 ){
                        if (sizeof($tweet_context->find('span[class=Icon--retweeted]')) > 0){
                            $tweet_is_retweet = true;
                            break;
                        }
                    }
                }
                $tweet_result->is_retweet = $tweet_is_retweet;

                //tweet text
                $tweet_text = "";
                $tweet_images = [];
                foreach($tweet->find('div[class=js-tweet-text-container]') as $tweet_content){
                    foreach($tweet_content->find('p[class=tweet-text]') as $tweet_content_text){
                        $tweet_text = str_replace("<a", " <a", $tweet_content_text->innertext);
                        $tweet_text = strip_tags($tweet_text);
                        break;
                    }
                    break;
                }
                $tweet_result->text = $tweet_text;

                //tweet time
                $time = null;
                $property = 'data-time';
                foreach($tweet->find('small[class=time]') as $tweet_time){
                    foreach($tweet_time->find('span[class=_timestamp]') as $timestamp){
                        $time = $timestamp->$property;
                        break;
                    }
                    break;
                }
                $tweet_result->time = $time;

                //media
                $media = [];
                foreach($tweet->find('div[class=AdaptiveMedia-container]') as $media_container){
                    foreach($media_container->find('img') as $image_tag){
                        array_push($media, $image_tag->src);
                    }
                    break;
                }
                $tweet_result->media = $media;

                $property = 'data-tweet-stat-count';
                //counts
                $replies = 0;
                $retweets = 0;
                $favourites = 0;
                foreach($tweet->find('div[class=ProfileTweet-actionCountList]') as $counts){
                    foreach($counts->find('span[class=ProfileTweet-action--reply]') as $reply_count){
                        foreach($reply_count->find('span[class=ProfileTweet-actionCount]') as $action_count){
                            $replies = (int) $action_count->$property;
                            break;
                        }
                        break;
                    }
                    foreach($counts->find('span[class=ProfileTweet-action--retweet]') as $reply_count){
                        foreach($reply_count->find('span[class=ProfileTweet-actionCount]') as $action_count){
                            $retweets = (int) $action_count->$property;
                            break;
                        }
                        break;
                    }
                    foreach($counts->find('span[class=ProfileTweet-action--favorite]') as $reply_count){
                        foreach($reply_count->find('span[class=ProfileTweet-actionCount]') as $action_count){
                            $favourites = (int) $action_count->$property;
                            break;
                        }
                        break;
                    }
                }
                $tweet_result->reply = $replies;
                $tweet_result->retweet = $retweets;
                $tweet_result->favourite = $favourites;

                array_push($tweet_results, $tweet_result);
            }
        }
        return $tweet_results;
    }
}
