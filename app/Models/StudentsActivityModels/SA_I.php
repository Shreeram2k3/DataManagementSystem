<?php
namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SA_I extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'StudentActivity_1';
    protected $fillable = [
        'date',
        'name_of_programme',
        'speaker_details',
        'topic',
        'outcome',
        'students_participated',
        'document_link',
        'Document',
        'user_id' // to store the user ID who created this record
    ];
    // public $timestamps = false;

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