<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class SA_V extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_5";
    protected $fillable=[

        'Name_of_Student(s)',
        'Roll_No',
        'Title_of_the_Model/Product_Developed',
        'Organizer_Details(Venue)',
        'Date',
        'Status(Further_enchancement/Final_stage)',
        'Document_Link',
        'Document',
        'user_id'
    ];

    // This defines the relationship with the users table
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // public $timestamps=false;

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
