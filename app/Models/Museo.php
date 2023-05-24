<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Museo extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $table = 'museo';

    protected $primaryKey = 'id';

    protected $fillable = ['titulo', 'descripcion', 'fecha', 'url_imagen'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
