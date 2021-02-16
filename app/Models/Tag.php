<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table='tags';
    protected $fillable=[
        'user_id',
        'username',
        'tags',
    ];
    public function main(){
        return $this->hasMany(Main::class);
    }
}
