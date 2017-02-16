<?php

use Illuminate\Database\Seeder;

class ProblemFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problemfile')->insert([
            'problem_id' => 1,
            'package' => 'default package',
            'filename' => 'CalculateSigmoid.java',
            'mime' => 'java',
            'code' => 'import java.util.Scanner;

public class CalculateSigmoid {
	
	public static double calculate(double num){
		double value = 1 / (1 + Math.exp(num));
		return value;
	}

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Scanner in = new Scanner(System.in);
		double value = in.nextDouble();
		System.out.print(calculate(value));
	}

}',
        ]);
    }
}
