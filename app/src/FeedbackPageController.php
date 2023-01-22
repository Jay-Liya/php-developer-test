<?php

namespace SilverStripe\Feedback;

use PageController;
use SilverStripe\Forms\FieldList;
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
        $fields = new FieldList(
            new TextField('FirstName', 'First Name'),
            new TextField('LastName', 'Last Name'),
            new EmailField('Email'),
            new TextareaField('Message')
        );
        $actions = new FieldList(
            new FormAction('submit', 'Submit')
        );
        return new Form($this, 'Form', $fields, $actions);
    }

    // submit action
    public function submit($data, $form)
    {
        $message = FeedbackMessage::create();
        $message->FirstName = $data['FirstName'];
        $message->LastName = $data['LastName'];
        $message->Email = $data['Email'];
        $message->Message = $data['Message'];
        $message->FeedbackPageID = $this->ID;
        $message->write();

        $form->sessionMessage('Thanks for your feedback!','good');

        return $this->redirectBack();
    }
}
