<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transaction_table";
    protected $fillable = ["value","flow","note","created_by"];
    protected $hidden = ["created_by"];

    public function user() {
        return $this->belongsTo('App\Models\User','created_by');
    }
}
