<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResultField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_result_id',
        'form_field_id',
        'value',
    ];

    public function field()
    {
        return $this->belongsTo(FormField::class, 'form_field_id');
    }
}
