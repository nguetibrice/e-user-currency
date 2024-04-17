<?php

namespace App\Utils;

use Monolog\Formatter\NormalizerFormatter;
use Illuminate\Http\Exceptions\HttpResponseException;
use Monolog\LogRecord;

class ElasticSearchFormatter extends NormalizerFormatter
{
    public function format(LogRecord $record)
    {
        $output1 = [];
        $date = $record['datetime'];
        $current_request = app()->request;
        if (isset($record['context']) && isset($record['context']['exception'])) {
            $response = $record['context']['response'] ?? null;
            $exception = $record['context']['exception'];
            $trace = array_slice(explode("\n", $exception->getTraceAsString()), 0, 5);
            $output1 = array_filter([
                "exception" => get_class($exception),
                "message" => $exception->getMessage(),
                "stacktrace" => implode(PHP_EOL, $trace),
                "response" => (is_object($response)) ? $response->getContent(): null,
            ]);
        }

        $output2 = [
            "message" => $record['message'] ?? $record['message'],
            // "context" => $record['context'] ?? $record['context'],
            "date" => $date->format('Y-m-d\TH:i:s.v'),
            "method" => $current_request->getMethod(),
            "payload" => $current_request->getContent(),
            "url" => [
                "full" => $current_request->getUri()
            ],

        ];
        $output = array_merge($output1, $output2);
        return json_encode($output) . "\n";
    }
}
