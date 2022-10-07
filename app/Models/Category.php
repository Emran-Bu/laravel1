<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'cat_name',
    ];

    // join with eloquent orm
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
