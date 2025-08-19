<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SA_XIV extends Model
{
    protected $primaryKey='S_NO';
    protected $table ="StudentActivity_14";
    protected $fillable=[
        
        'Date',
        'Batch',
        'Place',
        'Strength',
        'Remarks/Feedback_Received',
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
