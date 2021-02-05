<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand as Command;

class ModelMakeCommand extends Command 
{
    /* Get the default namespace for the class.  
    /*  
    /* @param_** _string $rootNamespace  
    /* @return_** _string  
    */

     protected function getDefaultNamespace($rootNamespace)
    {
        return "{$rootNamespace}\Models";
    }

}