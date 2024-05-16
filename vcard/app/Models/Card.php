<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $appends =[
        'fullname',
        'formatted_contact_number'
    ];

    public function getFullnameAttribute()
    {
        return $this->fname . ' ' . $this->mname.' ' . $this->lname;
    }

    public function setfnameAttribute($value)
    {
        $this->attributes['fname'] = ucwords($value);
    }

    public function setmnameAttribute($value)
    {
        $this->attributes['mname'] = ucwords($value);
    }

    public function setpositionAttribute($value)
    {
        $this->attributes['position'] = ucwords($value);
    }

    public function setlnameAttribute($value)
    {
        $this->attributes['lname'] = ucwords($value);
    }

    public function getFormattedContactNumberAttribute()
    {
        $number = $this->contact;

        $number = preg_replace('/\D/', '', $number);

        if (strlen($number) === 11 && substr($number, 0, 1) === '0') {
            $number = '63' . substr($number, 1);
        }

        if (strlen($number) === 12 && substr($number, 0, 2) === '63') {
            $formattedNumber = '+63' . substr($number, 2, 3) . ' ' . substr($number, 5, 3) . ' ' . substr($number, 8, 4);

            return $formattedNumber;
        }

        return $number;
    }
}