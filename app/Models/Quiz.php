<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quizzes';
    protected $fillable = [
        'id',
        'title',
        'category',
        'image'
    ];

    public $timestamps = true;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
