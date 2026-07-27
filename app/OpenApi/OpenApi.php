<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'My API',
    description: 'Backend API for developer landing page'
)]
#[OA\Server(
    url: 'http://my-api.local',
    description: 'Local server'
)]
class OpenApi
{
}