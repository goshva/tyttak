<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'status', 'phone', 'call_done', 'call_result'];

    // Status options
    public static function statuses()
    {
        return ['pending', 'approved', 'rejected'];
    }
}
