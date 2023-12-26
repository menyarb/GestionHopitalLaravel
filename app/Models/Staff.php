<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $primaryKey = 'StaffID';

    protected $fillable = [
        'Designation',
        'Highest_Qualification',
        'Salary',
        'DoctorID',
        'UserId',
        // Add other attributes as needed
    ];
    /*public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'DoctorID');
    }
    use HasFactory;*/

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Designation',
        'Highest_Qualification',
        'Salary',
        'DoctorID',
        'UserId',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'UserId' => 'Integer',
        'DoctorID'=>'Integer',
    ];
}
