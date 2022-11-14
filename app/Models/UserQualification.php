<?php

namespace App\Models;

use App\Models\subject;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserQualification extends Model
{
    use HasFactory;

    protected $table='user_qualification';

    protected $fillable = [
        'qualificationtype',
        'user_id',
        'qualificationname',
        'subject',
        'state',
        'university',
        'typeResult',
        'doq',
        'attempts',
        'percentage',
        'classGrade',
        'mode',
        'compulsorySubjects',
        'optionalSubjects'
    ];

    public function getSubjectNameFromSubjects(){
        $this->hasOne('App\Models\subject','subject_id','subject');
    }
    
    

    // public function sqlquery(){
    //     // UserQualification::select('*')        
    //     //  ->join('subject', 'subject.subject_id', '=', 'user_qualification.subject')
    //     //  ->select('user_qualification.qualificationtype', 'user_qualification.qualificationname','subject.subject_name')
    //     //  ->get();
    //     return $this->subject='1';
    // }
}
