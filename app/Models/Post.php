<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'content','start_date','end_date','guest_numbers','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
