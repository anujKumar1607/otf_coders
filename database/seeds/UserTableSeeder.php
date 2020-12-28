<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [];
        User::truncate();
        for($i = 1; $i <=1000; $i++){
        	$role = "Admin";
        	if($i == 1){
        		$role = "Admin";
        	}
        	$data[] = [
        		'name'=>Str::random(8),
        		'l_name'=>Str::random(8),
        		'phone'=>12345678,
        		'image'=>'160890334.jpeg',
        		'email'=>"demo".$i."@gmail.com",
        		'role'=>$role,
        		'password'=>bcrypt(Str::random(8)),
        	];
        }

        foreach ($data as $key => $value) {
        	# code...
        	User::create($value);
        }
    }
}
