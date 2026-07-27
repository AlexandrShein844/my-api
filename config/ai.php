<?php

return [

    'api_key' => env('OPENAI_API_KEY'),

    'base_url' => env(
        'OPENAI_BASE_URL',
        'https://openrouter.ai/api/v1'
    ),

    'model' => env(
        'OPENAI_MODEL',
        'google/gemini-2.0-flash-exp:free'
    ),

];