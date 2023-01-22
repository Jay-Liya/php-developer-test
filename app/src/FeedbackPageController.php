<?php

namespace SilverStripe\Feedback;

use PageController;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\Form;

class FeedbackPageController extends PageController
{
    private static $allowed_actions = ['Form'];

    // Creating the Form
    public function Form()
    {
        // Fields initialised with some constraints
        $fields = new FieldList(
            new TextField('FirstName', 'First Name','',20),
            new TextField('LastName', 'Last Name','',20),
            new EmailField('Email'),
            new TextareaField('Message')
        );

        $actions = new FieldList(
            new FormAction('submit', 'Submit')
        );

        // the required fields
        $required = new RequiredFields('FirstName', 'LastName', 'Email', 'Message');

        return new Form($this, 'Form', $fields, $actions, $required);
    }

    // submit action
    public function submit($data, $form)
    {
        $validateResult = $this->validate($data['FirstName'],$data['LastName'],$data['Message']);

        if($validateResult == 'good') {
            $message = FeedbackMessage::create();
            $message->FirstName = $data['FirstName'];
            $message->LastName = $data['LastName'];
            $message->Email = $data['Email'];
            $message->Message = $data['Message'];
            $message->write();

            $form->sessionMessage('Thanks for your feedback!', 'good');
        }
        else {
            $form->sessionMessage('Last Name contains characters other than letters.','bad');
        }

        return $this->redirectBack();
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $message
     * @return string
     */
    public function validate(string $firstName, string $lastName, string $message): string
    {
        $result = "good";
        // First Name validating for [A-Z] of both lower & upper cases
        if (!preg_match("#^[a-zA-Z ]+$#", $firstName)) {
            $result = 'First Name contains characters other than letters.';
        }
        // Last Name validating for [A-Z] of both lower & upper cases
        else if (!preg_match("#^[a-zA-Z ]+$#", $lastName)) {
            $result = 'Last Name contains characters other than letters.';
        }
        // Message validating for 255 characters
        else if (strlen($message) > 255) {
            $result = 'Message length exceeded maximum allowed length(255)';
        }
        return $result;
    }
}
