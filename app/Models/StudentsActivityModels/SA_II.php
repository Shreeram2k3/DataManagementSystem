<?php

namespace App\Models\StudentsActivityModels;

use Illuminate\Database\Eloquent\Model;

class SA_II extends Model
{
    protected $table="StudentActivity_2";
    protected $fillable = [
        'Name_of_student(s)',
        'Roll_No',
        'class',
        'Title_of_Event/Presentation',
        'Venue',
        'Prize/place',
        'Date',
        'Document_Link'
    ];
    public $timestamps = false;
}
