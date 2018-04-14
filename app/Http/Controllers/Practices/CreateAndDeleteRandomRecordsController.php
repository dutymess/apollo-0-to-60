<?php

namespace App\Http\Controllers\Practices;

use App\Http\Controllers\Controller;
use App\Models\Mission;

/**
 * This is an answer to the practice, described in Chapter 2, Lesson 2.
 * @link https://dutymess.github.io/laravel-0-to-60/chapter04/lesson02/simple-queries/
 *
 * Class MakeAndDeleteRandomRecordsController
 * @package App\Http\Controllers\Practices
 */
class CreateAndDeleteRandomRecordsController extends Controller
{
    private $first_inserted_id;
    private $last_inserted_id;

    /**
     * @return string
     */
    public function index()
    {
        $this->createRandomRecords();
        $this->deleteAllRecordsOneByOne();

        return "Done (hopefully) :D";
    }

    /**
     * Responsible to create all 100 records, asked in the question.
     */
    private function createRandomRecords()
    {
        $maximum_number = 100;

        for ($i = 1; $i <= $maximum_number; $i++) {
            $newly_inserted_record = $this->createARandomRecord();

            if ($newly_inserted_record->id) {
                if ($i == 1) {
                    $this->rememberFirstInsertedId($newly_inserted_record);
                } elseif ($i == $maximum_number) {
                    $this->rememberLastInsertedId($newly_inserted_record);
                }

            }
        }
    }

    /**
     * Responsible to create one random record.
     *
     * @return Mission
     */
    private function createARandomRecord()
    {
        $new_random_record = new Mission();

        $new_random_record->code = rand(1000000, 9999999);
        $new_random_record->title = "Random Record For Code No." . $new_random_record->code;
        $new_random_record->operator = "Random Operator For Code No." . $new_random_record->code;
        $new_random_record->save();

        return $new_random_record;
    }

    /**
     * Stores the first inserted id, in a controller's property.
     *
     * @param $record
     */
    private function rememberFirstInsertedId($record)
    {
        $this->first_inserted_id = $record->id;

        echo "Detected First Id: $record->id <br>";
    }

    /**
     * Stores the last inserted id, in a controller's property.
     *
     * @param $record
     */
    private function rememberLastInsertedId($record)
    {
        $this->last_inserted_id = $record->id;

        echo "Detected Last Id: $record->id <br>";
    }

    /**
     * Loops through all records and delete them, one by one, if they are within the range.
     */
    private function deleteAllRecordsOneByOne()
    {
        foreach (Mission::all() as $mission) {
            if ($mission->id >= $this->first_inserted_id and $mission->id <= $this->last_inserted_id) {
                $mission->delete();
            }
        }
    }
}
