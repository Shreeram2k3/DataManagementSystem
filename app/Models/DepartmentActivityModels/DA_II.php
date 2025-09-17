<?php
namespace App\Models\DepartmentActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DA_II extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'DepartmentActivity_2';
    protected $fillable = [
        'Name_of_the_Faculty',
        'Name_of_the_Equipment_failed/ Serviced',
        'Name_of_the_Lab',
        'Servicing_details',
        'Amount_Rs',
        'status',
        'Date',
        'Dept',
        'Document_Link',
        'Document',
        'user_id' // to store the user ID who created this record
    ];
    public $timestamps = false;


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