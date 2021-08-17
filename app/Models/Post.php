<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	use HasFactory;

	protected $fillable = ['title', 'slug', 'short_description', 'long_description', 'image_url', 'image_caption', 'user_id', 'showcase_flag'];

	public function user() {
		return $this->belongsTo(User::class);
	}

}
