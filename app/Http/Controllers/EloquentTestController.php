<?php

namespace App\Http\Controllers;

use App\Models\Mission;

class EloquentTestController extends Controller
{
    public function index()
    {
        return $this->massUpdate();
    }

    private function massUpdate()
    {
        $saved_record = Mission::find(112)->update([
            "code" => "1234" ,
        ]);

        return strval($saved_record);
    }
    private function massCreate()
    {
        $saved_record = Mission::create([
            "code" => "1234",
            "title" => "Mass Mission Test",
            "operator" => "Mass Operator Test",
        ]);

        return $saved_record->id;
    }

    private function destroyARecord($id)
    {
        return Mission::destroy($id);
    }

    private function deleteARecord($id)
    {
        $mission = Mission::find($id);
        return $mission->delete();

        return 'Deleted';
    }

    private function editARecord($id)
    {
        $mission = Mission::find($id);
        $mission->title .= ' - Edited!';
        $mission->save();

        return "Done!";
    }

    private function viewOneRecord($id)
    {
        return Mission::find($id);
    }

    private function viewAllRecords()
    {
        return Mission::all();
    }

    private function countAllRecords()
    {
        return Mission::count();
    }

    private function createOneRecordAndReturnId()
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


    private function createOneRecord()
    {
        $mission = new Mission();
        $mission->code = '5678';
        $mission->title = 'Second Test Mission';
        $mission->operator = "Test Operator #2";
        $mission->save();

        return "Another test record is inserted.";
    }
}
