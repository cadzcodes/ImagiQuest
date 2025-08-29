<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'galleries';

    // Define the fillable attributes for mass assignment
    protected $fillable = ['user_id', 'image_url', 'prompt'];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
