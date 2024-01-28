<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    protected $table ="book";
    public $fillable=[
        'title',
        'author',
        'publisher',
        'serial_number',
        'description',
        'available_quantity',
        'cat_name',
        'image',
        'resource',
        'able_to_borrow',
        'able_to_download'


    ];

    public function canBeBorrowed(): bool {
        return $this->activeLoans() <
         $this->available_quantity;
    }


    private function activeLoans(): int {
        return $this->loans()
            ->where('is_returned', false)
            ->get()
            ->sum('number_borrowed');
    }
    public function hasActiveLoan()
    {
        $activeLoans = $this->activeLoans();
        return $activeLoans > 0;
    }
    public function loans(): HasMany {
        return $this->hasMany(Loan::class);
    }


    public function availablequantity(): int {
        return $this->available_quantity
        - $this->activeLoans()
        ;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
