<?php

namespace App\Broadcasting\Centrifugo\Responses;

use GuzzleHttp\Psr7\Response as HttpResponse;
use Illuminate\Contracts\Support\Arrayable;

abstract class Response implements Arrayable
{
    public function __construct(HttpResponse $response)
    {
        $responseData = json_decode($response->getBody()->getContents(), true);

        foreach ($responseData['result'] as $key => $value) {
            $key = lcfirst($key);

            if (property_exists(static::class, $key) && $value !== null) {
                $this->$key = $value;
            }
        }
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
