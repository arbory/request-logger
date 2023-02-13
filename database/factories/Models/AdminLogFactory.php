<?php

namespace Arbory\AdminLog\Database\Factories\Models;

use Arbory\AdminLog\Models\AdminLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnchorLaneFactory extends Factory
{
    protected $model = AdminLog::class;

    public function definition(): array
    {
        return [
            'user_name' => $this->faker->email,
            'request_uri' => $this->faker->url,
            'ip' => $this->faker->ipv4,
            'ips' => $this->faker->ipv4,
            'request_method' => 'GET',
            'http_referer' => $this->faker->url,
            'user_agent' => $this->faker->userAgent,
            'http_content_type' => null,
            'http_cookie' => null,
            'session' => null,
            'content' => null,
        ];
    }
}
