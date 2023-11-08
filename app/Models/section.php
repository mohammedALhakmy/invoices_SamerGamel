<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $fillable = ['section_name_ar','section_name_en','description_en','created_by','description_ar','created_by'];
}
