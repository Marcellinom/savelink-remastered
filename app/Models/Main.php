<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='main';
    protected $fillable=[
        'user_id',
        'type',
        'name',
        'url',
        'img_url',
        'time',
        'img'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tags(){
        return $this->hasOne(Tag::class);
    }
}
