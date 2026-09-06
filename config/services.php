<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'youtube' => [
        'api_key' => env('YOUTUBE_API_KEY'),
        'client_id' => env('YOUTUBE_CLIENT_ID'),
        'client_secret' => env('YOUTUBE_CLIENT_SECRET'),
        'redirect' => env('YOUTUBE_REDIRECT_URI', env('APP_URL').'/auth/youtube/callback'),
        'authorize' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'token' => 'https://oauth2.googleapis.com/token',
        'scopes' => ['openid', 'profile', 'email', 'https://www.googleapis.com/auth/youtube.upload'],
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URI', env('APP_URL').'/auth/facebook/callback'),
        'authorize' => 'https://www.facebook.com/v20.0/dialog/oauth',
        'token' => 'https://graph.facebook.com/v20.0/oauth/access_token',
        'scopes' => ['pages_show_list', 'pages_manage_posts', 'pages_read_engagement'],
    ],

    'instagram' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('INSTAGRAM_REDIRECT_URI', env('APP_URL').'/auth/instagram/callback'),
        'authorize' => 'https://www.facebook.com/v20.0/dialog/oauth',
        'token' => 'https://graph.facebook.com/v20.0/oauth/access_token',
        'scopes' => ['pages_show_list', 'pages_read_engagement', 'instagram_basic', 'instagram_content_publish'],
    ],

    'tiktok' => [
        'client_id' => env('TIKTOK_CLIENT_KEY'),
        'client_secret' => env('TIKTOK_CLIENT_SECRET'),
        'redirect' => env('TIKTOK_REDIRECT_URI', env('APP_URL').'/auth/tiktok/callback'),
        'authorize' => 'https://www.tiktok.com/v2/auth/authorize/',
        'token' => 'https://open.tiktokapis.com/v2/oauth/token/',
        'scopes' => ['user.info.basic', 'video.upload', 'video.publish'],
    ],

];
