<?php

// In the generated Doctor.php model file
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $primaryKey = 'DoctorID';
    protected $fillable = [
        'Name',
        'Phone',
        'Address',
  
        'Gender',
        'DeptNo',
        'ReputeIndex',
        'Qualification',
        'Specialization',
        'Work_Experience',
        'Status',
        'img',
    ];

    // Define the relationship with the Department model
    public function department()
    {
        return $this->belongsTo(Department::class, 'DeptNo');
    }
}
