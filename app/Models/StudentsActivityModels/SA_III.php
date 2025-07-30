<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;

class SA_III extends Model
{
    protected $table = "StudentActivity_3";
    protected $fillable = [
        'Date',
        'Name_of_programme',
        'Speaker_details/Convener&details',
        'Coordinator',
        'Duration',
        'Dept',
        'Outcome',
        'CAMPUS_Document_ID'
    ];
    public $timestamps=false; // Assuming timestamps are not used
}
