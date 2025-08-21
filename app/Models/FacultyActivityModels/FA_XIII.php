<?php

namespace App\Models\FacultyActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FA_XIII extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'FacultyActivity_13';
    protected $fillable = [
        'Name_of_the_Faculty_Member',
        'Part_time/Full_Time',
        'Internal/External',
        'Name_of_the_Scholar',
        'Address_of_external',
        'Date_of_Registration',
        'Research_Area',
        'Status',
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
