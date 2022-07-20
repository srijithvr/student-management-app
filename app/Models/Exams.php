<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;
    public $totalMarks;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
    public function student()
    {
        return $this->hasOne(Students::class, 'id', 'student_id');
    }
    public function marks()
    {
        return $this->hasMany(Marks::class, 'exam_id', 'id');
    }
    public function totalMarks()
    { 
        $marks = Marks::selectRaw('sum(mark) as totalMarks')->where('exam_id', $this->id)->get()->first();  
        return $marks->totalMarks;
    }

}
