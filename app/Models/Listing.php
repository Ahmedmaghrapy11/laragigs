<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description'];

    public function scopeFilter($query, array $filters) {
        // tag filter
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%'. request('tag') . '%');
        }
        // search
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%'. request('search') . '%')
            ->orWhere('description', 'like', '%'. request('search') . '%')
            ->orWhere('tags', 'like', '%'. request('search') . '%');
        }
    }
    // relationship function
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
