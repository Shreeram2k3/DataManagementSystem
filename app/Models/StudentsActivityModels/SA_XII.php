<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SA_XII extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_12";
    protected $fillable=[
        
        'Others',
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
