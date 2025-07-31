<?php
namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SA_I extends Model
{
    use HasFactory;
    protected $table = 'StudentActivity_1';
    protected $fillable = [
        'date',
        'name_of_programme',
        'speaker_details',
        'topic',
        'outcome',
        'students_participated',
        'document_link',
        'user_id' // Assuming you want to store the user ID who created this record
    ];
    public $timestamps = false;
}