<?php

use Symfony\Component\HttpFoundation\Response;

function error(string $reason, int $status = 400, array $extra = []):Response
{
    
    $response = new Response(json_encode([
        'status' => 'error',
        'reason' => $reason,
        'errors' => $extra,
    ]), $status);

    $response->headers->set('Content-Type', 'application/json');

    return $response;
}
function success(string $message = "", int $status = 200, array $data = []): Response
{
    $response = new Response(json_encode([
        'status' => 'success',
        'message' => $message,
        'data' => $data,
    ]), $status);

    $response->headers->set('Content-Type', 'application/json');

    return $response;
}
function warning($errors): Response
{
    $response = new Response(json_encode([
        'status' => 'warning',
        'errors' => $errors,
    ]));

    $response->headers->set('Content-Type', 'application/json');

    return $response;
}
