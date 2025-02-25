<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Customer extends Model
{
    use HasFactory;
	protected $fillable = ['phone', 'address'];
	
	public function users()
    {
        return $this->belongsTo(User::class);
    }
}
