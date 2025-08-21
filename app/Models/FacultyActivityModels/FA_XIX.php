<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FA_XIX extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'FacultyActivity_19';
    protected $fillable = [
        'Name_of_the_Staff',
        'Faculty',
        'University',
        'Date_of_Recognition',
        'Reference_No',
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
