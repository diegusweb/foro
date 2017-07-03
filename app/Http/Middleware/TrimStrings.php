<?php
/**
 * Created by PhpStorm.
 * User: DIego
 * Date: 7/2/2017
 * Time: 9:32 PM
 */

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as BaseTrimmer;

class TrimStrings extends BaseTrimmer
{
        /**
         * The names of the attributes that should not be trimmed.
         *
         * @var array
         */
        protected $except = [
                'password',
                'password_confirmation',
            ];
}