<?php
namespace App\Models\FacultyActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FA_I extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'FAcultyActivity_1';
    protected $fillable = [
        'Name_of_the_Faculty',
        'ID',
        'Title_of_the_Paper',
        'Name_of_the_Journal_Volume',
        'Page_Nos_Impact_Factor_value',
        'National/International',
        'Scopus/SCI/others',
        'Dept',
        'Document_Link',
        'Document',
        'user_id' // to store the user ID who created this record
    ];
    // public $timestamps = false;


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