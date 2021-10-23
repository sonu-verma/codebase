<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codesnipt extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title','slug','description','code_snipt','image'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
