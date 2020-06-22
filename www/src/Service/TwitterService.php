<?php

namespace App\Service;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterService
{
    public function initializeOAuth() {

        $oauth = new TwitterOAuth("jAxFel5JdZl2o0O7p2fxw6zwS", "GoKRO6mVtmn4HAnLW9syEJ5dnmG45gqKZqFGbZUfH4dhWX3YhU");
        $accessToken = $oauth->oauth2('oauth2/token' , ['grant_type' => 'client_credentials']);

        $twitter = new TwitterOAuth("jAxFel5JdZl2o0O7p2fxw6zwS", "GoKRO6mVtmn4HAnLW9syEJ5dnmG45gqKZqFGbZUfH4dhWX3YhU", null, $accessToken->access_token);
        return $twitter;
    }

    public function getTweets(){

        $twitter = $this->initializeOAuth();
        $tweets = $twitter->get('statuses/user_timeline', ['screen_name' => 'ClmentDufour11', 'exclude_replies' => true]);

        return $tweets;

    }

    public function getKeywordsDataFirst($filters){

        $twitter = $this->initializeOAuth();

        $keywordsData = $twitter->get('search/tweets', ['q' => '%23truffaut', 'result_type' => 'recent', 'lang' => 'fr', 'count' => '50', 'until' => date('Y-m-d', time())]);

        return $keywordsData;

    }

    public function getKeywordsData($filters){

        $twitter = $this->initializeOAuth();
        $keywordsData = $twitter->get('search/tweets', ['q' => '%23truffaut', 'result_type' => 'recent', 'lang' => 'fr', 'count' => '50', 'since_id' => $max_id]);

        return $keywordsData;

    }
    // Returns the top 50 trending topics for a specific WOEID
    public function getTrendsPlace(){

        $twitter = $this->initializeOAuth();
        // id 615702 = Paris
        $trendings = $twitter->get('trends/place', ['id' => '615702']);

        return $trendings;

    }
}