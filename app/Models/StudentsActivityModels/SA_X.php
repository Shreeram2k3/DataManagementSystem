<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SA_X extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_10";
    protected $fillable=[
        
        'Semester',
        'Name_of_the_student',
        'Roll_No',
        'From_Date',
        'To_Date',
        'Industry_Details',
        'Stipend(Rs/Month)',
        'Nature_of_Training',
        'Duration',
        'Assessment',
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
