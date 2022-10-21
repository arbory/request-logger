<?php

namespace Arbory\AdminLog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $user_name
 * @property string $request_uri
 * @property string $ip
 * @property string $ips
 * @property string $request_method
 * @property string $http_referer
 * @property string $user_agent
 * @property string $http_content_type
 * @property string $http_cookie
 * @property string $session
 * @property string $content
 */
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
