<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model {

    use HasFactory;

    protected $table = 'links';

    protected $fillable = [
        'url_whatsapp',
        'url_instagram',
        'url_maps',
        'license'
    ];
}
