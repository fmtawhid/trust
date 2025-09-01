<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Abraham\TwitterOAuth\TwitterOAuth;
use Modules\AutoPost\Entities\AutoPostSetting;

class AutoSocialPostService
{
    /**
     * Summary of autoPost
     * @param mixed $news
     * @return array
     */
    public static function autoPost($news): array
    {
        // Facebook Auto Post
        $fb = AutoPostSetting::where('platform', 'facebook')->where('is_active', true)->first();
        if ($fb && $fb->access_token && $fb->page_id) {
            $result = self::postToFacebook($news, $fb->page_id, $fb->access_token);
            if (!$result['success']) return $result;
        }

        // Twitter Auto Post
        $tw = AutoPostSetting::where('platform', 'twitter')->where('is_active', true)->first();
        
        if ($tw) {
            if ($tw->is_test_mode) {
                $result = self::postFreeTweet(
                    $news,
                    $tw->api_key,
                    $tw->api_secret,
                    $tw->access_token,
                    $tw->access_token_secret
                );
                if (!$result['success']) return $result;
            } else {
                $result = self::postToTwitter(
                    $news,
                    $tw->api_key,
                    $tw->api_secret,
                    $tw->access_token,
                    $tw->access_token_secret
                );
                if (!$result['success']) return $result;
            }
        }

        return ['success' => true];
    }

   
    /**
     * Summary of postToFacebook
     * @param mixed $news
     * @param mixed $pageId
     * @param mixed $accessToken
     * @return array{message: mixed, platform: string, success: bool|array{message: string, platform: string, success: bool}|array{platform: string, success: bool}}
     */
    private static function postToFacebook($news, $pageId, $accessToken): array
    {
        try {
            $message = $news->title   . "\n\n" . Str::limit(clean_news_content($news->news), 120);
            $link = __url($news->encode_title);

            $response = Http::post("https://graph.facebook.com/{$pageId}/feed", [
                'message' => $message,
                'link' => $link,
                'access_token' => $accessToken,
            ]);


            if ($response->failed()) {
                \Log::error('Facebook post failed', ['response' => $response->body()]);
                $error = json_decode($response->body(), true);
                return [
                    'success' => false,
                    'platform' => 'facebook',
                    'message' => $error['error']['message'] ?? 'Unknown Facebook error'
                ];
            }

            return ['success' => true, 'platform' => 'facebook'];
        } catch (\Throwable $e) {
            \Log::error('Facebook post exception', ['exception' => $e]);
            return [
                'success' => false,
                'platform' => 'facebook',
                'message' => $e->getMessage()
            ];
        }
    }

    private static function postFreeTweet($news, $apiKey, $apiSecret, $accessToken, $accessTokenSecret): array
    {

        try {
            $twitter = new TwitterOAuth($apiKey, $apiSecret, $accessToken, $accessTokenSecret);

            // Twitter allows up to 280 characters, but URLs always count as 23 characters
            $url = __url($news->encode_title);
            $maxLength = 280;
            $urlLength = 24; // 23 (Twitter counts) + 1 (newline or space)
            $remaining = $maxLength - $urlLength;

            $title = $news->title;
            $titleLength = Str::length($title);

            if ($titleLength < $remaining) {
                $newsLength = $remaining - $titleLength - 1; // -1 for newline or space between title & news
                $body = Str::limit(clean_news_content($news->news), $newsLength-3);
                $text = $title . "\n" . $body . "\n" . $url;
            } else {
                $title = Str::limit($title, $remaining-3);
                $text = $title . "\n" . $url;
            }

            $tweet = $twitter->post("tweets", [
                "text" => $text
            ]);

            if (isset($tweet->errors)) {
                return [
                    'success' => false,
                    'platform' => 'twitter',
                    'message' => json_encode($tweet)
                ];
            } else {
                return ['success' => true, 'platform' => 'twitter'];
            }

        } catch (\Throwable $e) {
            \Log::error('Twitter post exception', ['exception' => $e]);
            return [
                'success' => false,
                'platform' => 'twitter',
                'message' => $e->getMessage()
            ];
        }
    }

    private static function postToTwitter($news, $apiKey, $apiSecret, $accessToken, $accessTokenSecret): array
    {
        try {
            $twitter = new TwitterOAuth($apiKey, $apiSecret, $accessToken, $accessTokenSecret);

            // URL length counting logic (same as free)
            $url = __url($news->encode_title);
            $maxLength = 280;
            $urlLength = 24;
            $remaining = $maxLength - $urlLength;

            $title = $news->title;
            $titleLength = Str::length($title);

            if ($titleLength < $remaining) {
                $newsLength = $remaining - $titleLength - 1;
                $body = Str::limit(clean_news_content($news->news), $newsLength - 3);
                $text = $title . "\n" . $body . "\n" . $url;
            } else {
                $title = Str::limit($title, $remaining - 3);
                $text = $title . "\n" . $url;
            }

            // Paid Twitter (v1.1) endpoint
            $tweet = $twitter->post("statuses/update", [
                "status" => $text
            ]);

            if ($twitter->getLastHttpCode() == 200) {
                return ['success' => true, 'platform' => 'twitter'];
            } else {
                return [
                    'success' => false,
                    'platform' => 'twitter',
                    'message' => json_encode($tweet)
                ];
            }

        } catch (\Throwable $e) {
            \Log::error('Twitter post exception', ['exception' => $e]);
            return [
                'success' => false,
                'platform' => 'twitter',
                'message' => $e->getMessage()
            ];
        }
    }
}

