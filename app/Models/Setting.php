<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];
    protected $casts = ['value' => 'array'];

    /**
     * Получение значения: Setting::get('address')
     * Кэшируется на время запроса.
     */
    public static function get(string $key, $default = null)
    {
        static $cache = [];
        if (! isset($cache[$key])) {
            try {
                $cache[$key] = static::where('key', $key)->value('value') ?? $default;
            } catch (\Throwable $e) {
                return $default;
            }
        }
        return $cache[$key];
    }

    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
