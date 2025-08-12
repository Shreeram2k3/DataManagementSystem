<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SA_VIII extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_8";
    protected $fillable=[
        'Name_of_Student(s)',
        'Roll_No',
        'Name_of_the_Organization',
        'Location',
        'Salary(Rs/Annum)',
        'Date_of_Interview',
        'Remarks',
        'Document_Link',
        'Document',
        'user_id'
    ];
    public $timestamps=false;

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
