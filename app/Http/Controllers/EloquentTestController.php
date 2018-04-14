<?php

namespace App\Http\Controllers;

use App\Models\Mission;

class EloquentTestController extends Controller
{
    public function index()
    {
        return $this->deleteARecord(5);
    }

    public function destroyARecord($id)
    {
        return Mission::destroy($id);
    }

    public function deleteARecord($id)
    {
        $mission = Mission::find($id);
        return $mission->delete();

        return 'Deleted';
    }

    public function editARecord($id)
    {
        $mission = Mission::find($id);
        $mission->title .= ' - Edited!' ;
        $mission->save();

        return "Done!";
    }
    public function viewOneRecord($id)
    {
        return Mission::find($id);
    }

    public function viewAllRecords()
    {
        return Mission::all();
    }

    public function countAllRecords()
    {
        return Mission::count();
    }

    public function createOneRecordAndReturnId()
    {
        $mission = new Mission();
        $mission->code = '5678';
        $mission->title = 'Second Test Mission';
        $mission->operator = "Test Operator #2";
        $mission->save();

        if ($mission->id) {
            return "Another test record is inserted, with id #" . $mission->id;
        } else {
            return "Something went wrong!";
        }
    }


    public function createOneRecord()
    {
        $mission = new Mission();
        $mission->code = '5678';
        $mission->title = 'Second Test Mission';
        $mission->operator = "Test Operator #2";
        $mission->save();

        return "Another test record is inserted.";
    }
}
