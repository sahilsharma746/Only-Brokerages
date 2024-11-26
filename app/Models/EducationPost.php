<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EducationPost extends Model
{
    use HasFactory, Notifiable;

 protected $table = 'education_posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


 /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image',
        'type',
    ];
    public function educationType(){
        return $this->belongsTo(EducationType::class, 'type');
    }

}
