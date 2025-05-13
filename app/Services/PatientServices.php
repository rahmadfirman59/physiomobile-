<?php

namespace App\Services;

use App\Models\Patient;

class PatientServices
{
    public function all()
    {
        return Patient::all();

    }

    public function create($data)
    {
        return Patient::create($data);
    }

    public function update($data, $id)
    {
        $patient = Patient::where("user_id",$id)->first();
        if ($patient)
        {
            $patient->update($data);
        }
        return $patient;

    }

    public function delete($id)
    {
        return Patient::destroy($id);

    }
}
