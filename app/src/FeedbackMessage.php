<?php

namespace SilverStripe\Feedback;

use SilverStripe\ORM\DataObject;

class FeedbackMessage extends DataObject
{
    // Declare table name
    private static $table_name = 'FeedbackMessage';

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

    // Sorted by First Name, Email, and submitted date
    private static $default_sort = ['FirstName', 'Email', 'Created'];

    // Searchable using First Name, Last Name, and Email
    private static $searchable_fields = [
        'FirstName',
        'LastName',
        'Email'
    ];

    // First Name, Last Name, Email, Message, and Submitted Date as columns
    private static $summary_fields = [
        'FirstName',
        'LastName',
        'Email',
        'Message',
        'Created'
    ];
}
