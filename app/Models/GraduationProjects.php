<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GraduationProjects extends Model
{
    use HasFactory;
    public $fillable=[
        'title',
        'student_name',
        'supervisor_name',
        'year',
        'dep_name',
        'image',
        'available_quantity',
        'resource',
        'able_to_borrow',
        'able_to_download'
    ];

    public function projectcanBeBorrowed(): bool {
        return $this->projectactiveLoans() <
        $this->available_quantity;
    }


    private function projectactiveLoans(): int {
        return $this->projectLoan()
            ->where('is_returned', false)
            ->get()
            ->sum('number_borrowed');
    }


    public function projectLoan(): HasMany {
        return $this->hasMany(projectLoan::class);
    }


    public function availablequantity(): int {
        return $this->available_quantity
        - $this->projectactiveLoans()
        ;
    }

    public function department()
    {
        return $this->belongsTo(Category::class);
    }

}

