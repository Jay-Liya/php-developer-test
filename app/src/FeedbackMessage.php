<?php

namespace SilverStripe\Feedback;

use SilverStripe\ORM\DataObject;

class FeedbackMessage extends DataObject
{
    // Define database columns
    private static $db = [
        'FirstName' => 'Varchar(255)',
        'LastName' => 'Varchar(255)',
        'Email' => 'Varchar(255)',
        'Message' => 'Text'
    ];

    // Define relationship
    private static $has_one = [
        'FeedbackPage' => FeedbackPage::class
    ];
}
