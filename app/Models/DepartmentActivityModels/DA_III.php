<?php
namespace App\Models\DepartmentActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DA_III extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'DepartmentActivity_3';
    protected $fillable = [
        'Total_Number_of_Titles',
        'Total_Number_of_Books',
        'Total_Number_of_Reference_Books',
        'Total_Number_of_Journals_Subscribed_National',
        'Total_Number_of_Journals_Subscribed_International',
        'Total_Value_of_Books/Journals_Investment(National)',
        'Total_Value_of_Books/Journals_Investment(international)',
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