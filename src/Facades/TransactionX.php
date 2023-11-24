<?php

namespace RajenTrivedi\TransactionX\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rajen Trivedi\TransactionX\TransactionX
 */
class TransactionX extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RajenTrivedi\TransactionX\TransactionX::class;
    }
}
