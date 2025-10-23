<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SA_VII extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_7";
    protected $fillable=[
        'Month',
        'Name_of_Student(s)',
        'Roll_No',
        'Staff(if_guided)',
        'Title_of_the_Paper',
        'Name_of_the_Journal',
        'Volume_No',
        'Page_Nos',
        'Conference_Details',
        'National/International',
        'Dept',
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
