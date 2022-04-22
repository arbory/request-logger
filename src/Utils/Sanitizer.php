<?php

namespace Arbory\AdminLog\Utils;

use Illuminate\Support\Arr;

class Sanitizer
{
    /** @var array */
    protected $config;

    /** @var string */
    protected $removeValueNotification;

    /** @var array */
    protected $sensitiveStringPatterns;

    /** @var array */
    protected $sensitiveKeyPatterns;

    public function __construct()
    {
        $this->config = config('admin-log.sanitizer');
    }

    protected function setSensitiveStringPatterns(): void
    {
        $identifiers = Arr::get($this->config, 'sensitive_string_identifiers');

        $this->sensitiveStringPatterns = array_map(function ($identifier) {
            return '/(?<=\b' . $identifier . '=)(.+)(\b)/U';
        }, $identifiers);
    }

    protected function getSensitiveStringPatterns(): array
    {
        if (!isset($this->sensitiveStringPatterns)) {
            $this->setSensitiveStringPatterns();
        }

        return $this->sensitiveStringPatterns;
    }

    protected function getRemovedValueNotification(): string
    {
        if (!$this->removeValueNotification) {
            $this->removeValueNotification = Arr::get($this->config, 'removed_value_notification');
        }

        return $this->removeValueNotification;
    }

    public function sanitize(array|string $value): array|string
    {
        if (is_string($value)) {
            return $this->sanitizeString($value);
        } elseif (is_array($value)) {
            return $this->sanitizeArray($value);
        }

        return $value;
    }

    protected function sanitizeString(string $string): string
    {
        return preg_replace(
            $this->getSensitiveStringPatterns(),
            $this->getRemovedValueNotification(),
            $string
        );
    }

    protected function sanitizeArray(array $array): string
    {
        $array = $this->sanitizeArrayValues($array);

        return $this->sanitizeString(print_r($array, true));
    }

    protected function sanitizeArrayValues(array $array): array
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {

                if (is_object($value)) {
                    if ($value instanceof \Closure) {
                        $value = null;
                    }
                    $value = (array)$value;
                    $array[$key] = $value;
                }

                if ($this->isSensitiveArrayKey($key)) {
                    $array[$key] = $this->getRemovedValueNotification();
                    continue;
                }

                if (is_array($value)) {
                    $array[$key] = $this->sanitizeArrayValues($value);
                }
            }
        }

        return $array;
    }

    protected function isSensitiveArrayKey(string $key): bool
    {
        $patterns = $this->getSensitiveKeyPatterns();

        foreach ($patterns as $pattern) {
            if (preg_match('/^' . $pattern . '$/i', $key)) {
                return true;
            }
        }

        return false;
    }

    protected function getSensitiveKeyPatterns(): array
    {
        if (!$this->sensitiveKeyPatterns) {
            $this->sensitiveKeyPatterns = array_merge(
                Arr::get($this->config, 'sensitive_key_patterns'),
                Arr::get($this->config, 'sensitive_string_identifiers')
            );
        }

        return $this->sensitiveKeyPatterns;
    }
}
