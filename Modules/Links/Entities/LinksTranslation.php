<?php

namespace Modules\Links\Entities;

use Illuminate\Database\Eloquent\Model;

class LinksTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'links__links_translations';
}
