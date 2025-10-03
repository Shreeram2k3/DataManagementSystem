<?php
namespace App\Models\DepartmentActivityModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DA_XI extends Model
{
    use HasFactory;
    protected $primaryKey='S_NO';
    protected $table = 'DepartmentActivity_11';
    protected $fillable = [
        'AY-SEM',
        'YEAR',
        'Document_Link',
        'Document',
        'user_id' // to store the user ID who created this record
    ];
    // public $timestamps = false;


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