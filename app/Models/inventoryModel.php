<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class inventoryModel extends Model
{
    use HasFactory;

    static function getCollections(){
        $data=DB::table('collections')->get();
        return $data;
    }
}
