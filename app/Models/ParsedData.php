<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParsedData extends Model
{
    public function type() {
      return $this->belongsTo(Type::class);
    }
}
