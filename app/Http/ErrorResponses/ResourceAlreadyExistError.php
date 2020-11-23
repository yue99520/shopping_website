<?php


namespace App\Http\ErrorResponses;


class ResourceAlreadyExistError
{
    public static function response()
    {
        return response('Resource already exists.', 400);
    }
}
