<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['category', 'title', 'file_url', 'published_at', 'sort_order'];
    protected $casts = ['published_at' => 'date'];
}