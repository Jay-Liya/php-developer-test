<?php

namespace SilverStripe\Feedback;

use Page;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\View\ArrayData;

class FeedbackPage extends Page
{
    // Get date and submissions
    public function submissions()
    {
        $list = ArrayList::create();
        // SQL query
        $query = SQLSelect::create()
            ->setFrom("FeedbackMessage")
            ->setSelect(["DATE_FORMAT(Created,'%d %M %Y') AS date", 'COUNT(*) AS submissions'])
            ->setGroupBy("date")
            ->setOrderBy("date","DESC")
            ->setLimit(10);

        $result = $query->execute();

        if ($result) {
            while ($record = $result->nextRecord()) {
                // push date and submissions to array
                $list->push(ArrayData::create([
                    'date' => $record["date"],
                    'submissions' => $record["submissions"]
                ]));
            }
        }

        return $list;
    }
}
