<?php

namespace Arbory\AdminLog\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    /** @var string */
    protected $table = 'admin_log';

    /** @var array */
    protected $fillable = [
        'user_name',
        'request_uri',
        'ip',
        'ips',
        'request_method',
        'http_referer',
        'user_agent',
        'http_content_type',
        'http_cookie',
        'session',
        'content'
    ];

    public function __toString(): string
    {
        return (string)$this->user_name;
    }
}