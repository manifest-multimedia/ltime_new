<?php

return [
    'default_language' => 'en',
    'user_model' => \App\Models\User::class,
    'reading_progress_bar' => true,
    'include_default_routes' => false,
    
    'blog_prefix' => "insights",
    'admin_prefix' => "manage-insights",
    
    'use_custom_view_files' => false,
    'per_page' => 10,
    
    'image_upload_enabled' => true,
    'blog_upload_dir' => "blog_images",
    'memory_limit' => '2048M',
    
    'image_sizes' => [
        'image_large' => [
            'w' => 1000,
            'h' => 700,
            'basic_key' => "large",
            'name' => "Large",
            'enabled' => true,
            'crop' => true,
        ],
        'image_medium' => [
            'w' => 600,
            'h' => 400,
            'basic_key' => "medium",
            'name' => "Medium",
            'enabled' => true,
            'crop' => true,
        ],
        'image_thumbnail' => [
            'w' => 150,
            'h' => 150,
            'basic_key' => "thumbnail",
            'name' => "Thumbnail",
            'enabled' => true,
            'crop' => true,
        ],
    ],
    
    'captcha' => [
        'captcha_enabled' => true,
        'captcha_type' => \App\Services\Insights\Captcha\BasicCaptcha::class,
        'basic_question' => "What is the opposite of white?",
        'basic_answers' => "black,dark",
    ],
    
    'comments' => [
        'type_of_comments_to_show' => 'built_in',
        'max_num_of_comments_to_show' => 1000,
        'save_ip_address' => true,
        'auto_approve_comments' => false,
        'save_user_id_if_logged_in' => true,
        'user_field_for_author_name' => "name",
        'ask_for_author_email' => true,
        'require_author_email' => false,
        'ask_for_author_website' => true,
    ],
    
    'search' => [
        'search_enabled' => true,
        'limit-results' => 50,
        'enable_wildcards' => true,
        'weight' => [
            'title' => 1.5,
            'content' => 1,
        ],
    ],
    
    'show_full_text_at_list' => true,
];