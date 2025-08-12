<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SA_IX extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_9";
    protected $fillable=[
        
        'Semester',
        'Name_of_Course',
        'Name_of_Faculty/Resource_Person',
        'From_Date',
        'To_Date',
        'Value_Added/One_Credit',
        'Coordinator',
        'Dept',        
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
