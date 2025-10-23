<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SA_XIII extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_13";
    protected $fillable=[
        
        'Semester',
        'From_Date',
        'To_Date',
        'Factory_Visited',
        'Name_of_the_staff/Students',
        'Department',
        'Assessment_Details',
        'Document_Link',
        'Document',
        'user_id'
    ];
    // public $timestamps=false;

    // This defines the relationship with the users table
     public function user()
    {
        return $this->belongsTo(User::class);
    }

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
