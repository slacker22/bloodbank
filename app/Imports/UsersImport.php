<?php

namespace App\Imports;


use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;


class UsersImport implements ToCollection , WithStartRow
{
    /**
     * @inheritDoc
     */
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        $blood_groups=[
            'O+'=>1,
            'O-'=>2,
            'A+'=>3,
            'A-'=>4,
            'B+'=>5,
            'B-'=>6,
            'AB+'=>7,
            'AB-'=>8

        ];
        $gender=[
            'M'=>1,
            'F'=>2
        ];

        foreach ($rows as $row) {

            $user= User::create([
                'first_name'  => $row[0],
                'last_name'   => $row[1],
                'gender'      => $gender[$row[2]],
                'phone'       => $row[3],
                'email'       => $row[4],
                'user_name'   => $row[0].'.'.$row[1].'.'.rand(100000,999999),
                'password'    =>bcrypt($row[3]),
                'user_type_id'=>5,
            ]);
            $user->donor()->create([

                'ssn'             => $row[5],
                'blood_group_id'  => $blood_groups[$row[6]],
                'donor_type_id'   => 1
            ]);
        }
    }
}
