<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    use BaseModel;
    protected $guarded = [];
    protected $fillable = [
        "code",
        "description",
        "rate",
        "status",
    ];

}
