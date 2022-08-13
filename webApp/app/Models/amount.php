<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class amount extends Model
{
    use HasFactory;

    public function member(){
        return $this->beLongsTo(member::class, "memberid");
    }

    public function paymentgetway(){
        return $this->beLongsTo(paymentgetway::class, "getwayid");
    }

    public function User(){
        return $this->beLongsTo(User::class, "prepare_by");
    }


}
