<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = ['user_id', 'status', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
