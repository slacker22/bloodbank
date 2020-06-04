<?php

use Illuminate\Database\Seeder;
use App\Patients;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = [
            [
                'first_name'=>'patient1',
                'last_name'=>'patient1',
                'ssn'=>'29804111801234',
                'gender'=>1,
                'blood_group_id'=>1,
                'phone'=>'01006816600',
                'address'=> 'address address address address'
            ],

            [
                'first_name'=>'patient2',
                'last_name'=>'patient2',
                'ssn'=>'29804111801223',
                'gender'=>2,
                'blood_group_id'=>2,
                'phone'=>'01006816601',
                'address'=> 'address address address address'
            ],

            [
                'first_name'=>'patient3',
                'last_name'=>'patient3',
                'ssn'=>'29804111802324',
                'gender'=>1,
                'blood_group_id'=>3,
                'phone'=>'01006816602',
                'address'=> 'address address address address'
            ],


        ];

        foreach ($patients as $patient) {
            Patients::create($patient);
        }
    }
}
