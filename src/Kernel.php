<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    // public function test($oRequest){

    // }
    use MicroKernelTrait;

    // public function handle(){
    //     echo "hello";
    // }
}
