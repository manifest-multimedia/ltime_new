<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class InsightsException extends Exception
{
    public static function logAndThrow($message, $context = [])
    {
        Log::error('Insights Error: ' . $message, $context);
        throw new self($message);
    }

    public static function invalidTranslation($model, $langId)
    {
        return self::logAndThrow(
            "No translation found for {$model} with language ID {$langId}",
            ['model' => $model, 'lang_id' => $langId]
        );
    }

    public static function imageUploadFailed($error)
    {
        return self::logAndThrow(
            "Failed to upload image: {$error}",
            ['error' => $error]
        );
    }

    public static function commentNotAllowed($reason)
    {
        return self::logAndThrow(
            "Comment not allowed: {$reason}",
            ['reason' => $reason]
        );
    }

    public static function dataMigrationFailed($error)
    {
        return self::logAndThrow(
            "Data migration failed: {$error}",
            ['error' => $error]
        );
    }
}