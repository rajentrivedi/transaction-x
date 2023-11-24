<?php

namespace RajenTrivedi\TransactionX\Facades;

use Illuminate\Support\Facades\Facade;

class TransactionX extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RajenTrivedi\TransactionX\TransactionX::class;
    }
}
