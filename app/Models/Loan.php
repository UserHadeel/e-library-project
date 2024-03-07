<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'number_borrowed',
        'return_date',
        'book_id',
        'user_id',
    ];


    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }


    public function book(): BelongsTo {
        return $this->belongsTo(Book::class);
    }

//     public function project()
// {
//     return $this->belongsTo(GraduationProjects::class);
// }

    public function terminate() {
        $this->is_returned = true;
        $this->save();
    }
}
