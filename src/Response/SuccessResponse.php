<?php

namespace Rdhdev\StndResponse\Response;

use Rdhdev\StndResponse\StatusCode;

class SuccessResponse 
{
    public function successGetData()
    {
        return "successfully get data " . StatusCode::HTTP_CREATED;
    }
}