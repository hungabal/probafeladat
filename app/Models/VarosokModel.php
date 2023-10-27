<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarosokModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'varosok';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'va_id';

    /**
     * timestamp mezők egységesítése a többi mező névvel
     */
    const CREATED_AT = 'va_created';
    const UPDATED_AT = 'va_updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['va_id','va_meid','va_nev'];
}
