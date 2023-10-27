<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MegyekModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'megyek';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'me_id';

    /**
     * timestamp mezők egységesítése a többi mező névvel
     */
    const CREATED_AT = 'me_created';
    const UPDATED_AT = 'me_updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['me_id','me_nev'];
}
