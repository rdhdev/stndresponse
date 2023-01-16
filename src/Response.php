<?php

namespace Rdhdev\StndResponse;

use Rdhdev\StndResponse\StatusCode;
use Rdhdev\StndResponse\Message;

class Response 
{

    public function templateResponse($message, $code, $data = null, $error = null)
    {
        $response = [
            'message' => $message,
            'code'    => $code
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        if (!is_null($error)) {
            $response['error'] = $error;
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

    private function responseErrorGenerator($validator)
    {
        $message = [];
        foreach ($validator->getRules() as $key => $value) {
            $message[$key] = $validator->errors()->first($key);
        }

        return $message;
    }

    public function badRequest($validator)
    {
        $error = $this->responseErrorGenerator($validator);
        $response = $this->templateResponse(Message::BAD_REQUEST, StatusCode::HTTP_BAD_REQUEST, null, $error);

        return json_encode($response);
    }

    public function internalServerErrorResponse($message = null)
    {
        $message = $message ?? Message::UNKNOWN;
        $response = $this->templateResponse($message, StatusCode::HTTP_INTERNAL_SERVER_ERROR);

        return json_encode($response);
    }

    public function unathorized()
    {
        $response = $this->templateResponse(Message::UNATHORIZED, StatusCode::HTTP_UNATHORIZED);

        return json_encode($response);
    }

    public function notFound()
    {
        $response = $this->templateResponse(Message::NOT_FOUND, StatusCode::HTTP_NOT_FOUND);

        return json_encode($response);
    }
}