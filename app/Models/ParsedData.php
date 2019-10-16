<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ParsedData extends Model  
{

  public function type() {
    return $this->belongsTo(Type::class);
  }

  public function getCreatedDateAttribute()
  {
  	return Carbon::parse($this->date_published_at)->format('d-m-Y H:i');
  }

}
