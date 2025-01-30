<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'polygon' => 'object',
    ];

    public function getImage()
    {
        if (substr($this->image, 0, 5) == "https") {
            return $this->image;
        }

        if ($this->image) {
            return asset('/uploads/imgCover/' . $this->image);
        }

        return asset('/images/placeholder.jpg/');
    }
}
