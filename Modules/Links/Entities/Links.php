<?php

namespace Modules\Links\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    use Translatable;

    protected $table = 'links__links';
    public $translatedAttributes = [];
    protected $fillable = [];
}
