<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class projectLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'number_borrowed',
        'return_date',
        'graduation_projects_id',
        'user_id',
    ];


    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }


    public function graduation_projects(): BelongsTo {
        return $this->belongsTo(GraduationProjects::class);
    }


    public function terminate() {
        $this->is_returned = true;
        $this->save();
    }
}
