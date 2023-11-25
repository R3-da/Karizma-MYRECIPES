<?php

/**
 * Created by John Dave Decano<johndavedecano@gmail.com>.
 * Date: Mon, 16 Apr 2018 18:21:38 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recipe
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $ingredients
 * @property string $instructions
 * @property int $duration
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Recipe extends Model
{
    use HasUser;

    protected $casts = [
        'user_id' => 'int',
        'duration' => 'int',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'ingredients',
        'instructions',
        'duration',
        'status'
    ];
}
