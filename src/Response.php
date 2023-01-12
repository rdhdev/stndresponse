<?php

namespace Rdhdev\StndResponse;

use Rdhdev\StndResponse\StatusCode;
use Rdhdev\StndResponse\Message;

class Response 
{

    public function templateResponse($message, $code, $data = null)
    {
        $response = [
            'message' => $message,
            'code'    => $code
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return $response;
    }

    public function success($data = null)
    {
        $response = $this->templateResponse(Message::SUCESS, StatusCode::HTTP_OK, $data);

        return json_encode($response);
    }

    public function created()
    {
        $response = $this->templateResponse(Message::CREATED, StatusCode::HTTP_CREATED);

        return json_encode($response);

    }

}