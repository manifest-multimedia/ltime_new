<?php

namespace App\Services\Insights\Captcha;

class BasicCaptcha
{
    /**
     * Verify the captcha answer against the allowed answers
     * 
     * @param string $answer The user's answer to verify
     * @return bool
     */
    public function verify(string $answer): bool
    {
        $allowedAnswers = explode(',', config('insights.captcha.basic_answers', ''));
        
        // Convert to lowercase and trim for comparison
        $answer = strtolower(trim($answer));
        
        // Check if the provided answer matches any allowed answer
        foreach ($allowedAnswers as $allowedAnswer) {
            if ($answer === strtolower(trim($allowedAnswer))) {
                return true;
            }
        }
        
        return false;
    }
}