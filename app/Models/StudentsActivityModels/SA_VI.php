<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class SA_VI extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_6";
    protected $fillable=[
        'Name_of_Student(s)',
        'Roll_No',
        'Date',
        'Event',
        'Place',
        'Participation/Prize',
        'Remark',
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
