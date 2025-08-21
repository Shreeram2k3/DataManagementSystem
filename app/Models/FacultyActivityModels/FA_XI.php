<?php

namespace App\Models\FacultyActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FA_XI extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'FacultyActivity_11';
    protected $fillable = [
        'Name_of_Staff',
        'Name_of_the_Programme',
        'BIT/Outside',
        'Duration',
        'Outcome',
        'Dept',
        'Document_Link',
        'Document',
        'user_id' // to store the user ID who created this record
    ];
    public $timestamps = false;


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($activity) {
            if ($activity->Document && Storage::disk('public')->exists($activity->Document)) {
                Storage::disk('public')->delete($activity->Document);
            }
        });
    }



}
