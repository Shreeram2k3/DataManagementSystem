<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SA_IV extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_4";
    protected $fillable =[
        'Name_of_student(s)',
        'user_id',
        'Roll_No',
        'Name_of_the_Guide',
        'Title_of_Project',
        'Submitted/Sanctioned',
        'Sponsoring_Agency_(Date of Submission/Sanctioned',
        'Amount_Sanctioned_in_(Rs)',
        'Dept',
        'Document_Link',
        'Document'
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
