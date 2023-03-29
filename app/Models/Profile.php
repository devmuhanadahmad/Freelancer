<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $guarded=[];

/*
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'birthday', 'gender',
        'street_address', 'city', 'state', 'postal_code', 'country',
        'locale','image'
    ];
*/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

      //Accessors image
      public function getImageUrlAttribute()
      {
          if (!$this->image) {
              return 'https://www.firstcolonyfoundation.org/wp-content/uploads/2022/01/no-photo-available.jpeg';
          }
          if (Str::startsWith($this->image, ['http://', 'https://'])) {
              return $this->image;
          }
          return asset('storage/' . $this->image);
      }
}
