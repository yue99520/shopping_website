<?php


namespace App\Http\ErrorResponses;


class ResourceNotFoundError
{
    public static function response()
    {
        return response('Resource not found', 400);
    }
}
