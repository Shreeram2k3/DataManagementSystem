<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SA_II extends Model
{
    protected $primaryKey='S_NO';
    protected $table="StudentActivity_2";
    protected $fillable = [
        'Name_of_student(s)',
        'Roll_No',
        'class',
        'Title_of_Event/Presentation',
        'Venue',
        'Prize/place',
        'Date',
        'Document_Link',
        'Document',
        'user_id'  // to store the user ID who created this record
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
