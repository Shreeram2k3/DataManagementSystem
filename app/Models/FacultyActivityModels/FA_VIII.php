<?php
namespace App\Models\FacultyActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FA_VIII extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'FacultyActivity_8';
    protected $fillable = [
        'Name_of_winter/SummerSchool/FDPTitle_of_the_programme',
        'Name_of_the_coordinator(s)',
        'Total_No_of_Participants(TN)',
        'Total_No_of_Participants(Others)',
        'Total_No_of_Participants(BIT)',
        'From_date',
        'To_date',
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