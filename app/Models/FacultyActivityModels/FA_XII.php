<?php

namespace App\Models\FacultyActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FA_XII extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'FacultyActivity_12';
    protected $fillable = [
        'Name_of_Staff',
        'Programme_of_study',
        'Name_of_Institute_&_University',
        'Date_of_Admission_Completed',
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
