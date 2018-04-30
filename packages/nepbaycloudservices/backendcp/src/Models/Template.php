<?php
/**
 * Created by PhpStorm.
 * User: ncs2
 * Date: 4/19/18
 * Time: 2:40 PM
 */

namespace Nepbaycloudservices\Backendcp\Models;

use Illuminate\Database\Eloquent\Model;


class Template extends Model
{
    protected $fillable=['title', 'photo', 'section','status'];
}
