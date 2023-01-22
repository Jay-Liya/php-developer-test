<?php

use SilverStripe\Dev\SapphireTest;
use SilverStripe\Feedback\FeedbackPageController;

class FeedbackPageTest extends SapphireTest
{
    /**
     * Testing validate
     */
    public function testValidate()
    {
        $feedbackPage = new FeedbackPageController;

        // Success case
        $result = $feedbackPage->validate('John', 'Brown', 'This is my test message');
        $this->assertEquals('good', $result);

        // Fail case - First name with special character
        $result = $feedbackPage->validate('John#', 'Brown', 'This is my test message');
        $this->assertEquals('First Name contains characters other than letters.', $result);

        // Fail case - Last name with number
        $result = $feedbackPage->validate('John', 'Brown8', 'This is my test message');
        $this->assertEquals('Last Name contains characters other than letters.', $result);

        // Fail case - more than 255 characters
        $testString = "Submission should be sorted by First Name, Email, and submitted date.
Submission should be searchable using First Name, Last Name, and Email.
Submission should be sorted by First Name, Email, and submitted date.
Submission should be searchable using First Name, Last Name, and Email.
Submission should be sorted by First Name, Email, and submitted date.
Submission should be searchable using First Name, Last Name, and Email.
Submission should be sorted by First Name, Email, and submitted date.
Submission should be searchable using First Name, Last Name, and Email.
Submission should be sorted by First Name, Email, and submitted date.
Submission should be searchable using First Name, Last Name, and Email.
Submission should be sorted by First Name, Email, and submitted date.
Submission should be searchable using First Name, Last Name, and Email.
Submission should be sorted by First Name, Email, and submitted date.
Submission should be searchable using First Name, Last Name, and Email.";
        $result = $feedbackPage->validate('John', 'Brown', $testString);
        $this->assertEquals('Message length exceeded maximum allowed length(255)', $result);
    }
}
