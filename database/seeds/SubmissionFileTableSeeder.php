<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SubmissionFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('submissionfile')->insert([
            'submission_id' => 1,
            'package' => 'default package',
            'filename' => 'Runners.java',
            'mime' => 'java',
            'code' => 'import java.util.Comparator;
import java.util.Scanner;
import static java.util.Comparator.*;
import java.util.ArrayList;
import java.util.Collections;

@Required
public class Runners {
    
    @Required
    static int round;
    @Required
    static float time;
    
    public static void main(String[] args) {
        Scanner in = new Scanner(System.in);
        /*round = in.nextInt();
        Comparator<Runner> com = comparing(Runner::getTotalTime).thenComparing(Runner::getWasteTime, reverseOrder());
        for (int i = 0; i < round; i++) {
            int numPeople = in.nextInt();
            float range = in.nextInt();
            ArrayList<Runner> ar = new ArrayList<Runner>();
            for (int j = 0; j < numPeople; j++) {
                    Runner r = new Runner(j+1, in.nextInt(), in.nextFloat());
                    time = range / r.getSpeed();
                    //System.out.println(time);

                    time += r.getWasteTime() / 1000;
                    //System.out.println(r.getWasteTime() / 100);

                    r.setTotalTime(time);
                    ar.add(r);
            }
            
            Collections.sort(ar, com);

            for (int j = 0; j < ar.size(); j++) {
                    Runner r = ar.get(j);
                    System.out.println(r.getNo());
            }
        }*/
        int num = in.nextInt();
        System.out.println(num);

    }
    @Required
    public void printTest(){
        
    }
}

@Required
class Runner {
        @Required
	int no;
        @Required
	int speed;
        @Required
	float wasteTime;
        @Required
	float totalTime;
	@Required
	public Runner(int no ,int speed, float wasteTime) {
		this.no = no;
		this.speed = speed;
		this.wasteTime = wasteTime;
	}
	@Required
	public int getNo() {
		return no;
	}
        @Required
	public void setNo(int no) {
		this.no = no;
	}
        @Required
	public int getSpeed() {
		return speed;
	}
        @Required
	public void setSpeed(int speed) {
		this.speed = speed;
	}
        @Required
	public float getWasteTime() {
		return wasteTime;
	}
        @Required
	public void setWasteTime(float wasteTime) {
		this.wasteTime = wasteTime;
	}
        @Required
	public float getTotalTime() {
		return totalTime;
	}
        @Required
	public void setTotalTime(float totalTime) {
		this.totalTime = totalTime;
	}
}

/*

3 
3 120 
10 120 
12 2120 
13 120 
4 500 
13 3300 
12 0 
10 20 
12 550 
4 90 
3 0 
6 15000 
9 20000 
1 0

*/
',
        ]);

        DB::table('submissionfile')->insert([
            'submission_id' => 2,
            'package' => 'default package',
            'filename' => 'PrimeNumber.java',
            'mime' => 'java',
            'code' => 'import java.util.Scanner;
public class PrimeNumberFinder {
	
	int num;
	
	public PrimeNumberFinder(){
		
	}

	boolean isPrime(int n) {
		if(n == 1) return false;
		
	    if(n == 2) return true;
		
	    if (n%2==0) return false;
	    
	    for(int i=3;i*i<=n;i+=2) {
	        if(n%i==0)
	            return false;
	    }
	    return true;
	}
	
	public static void main(String[] args) {
		Scanner in = new Scanner(System.in);
		int start = in.nextInt();
		int end = in.nextInt();
		PrimeNumberFinder finder = new PrimeNumberFinder();
		int count = 0;
		
		for (int i = start; i <= end; i++) {
			if(finder.isPrime(i)){
				System.out.print(i+" ");
				count++;
			}
		}
		
		System.out.println(count);

	}

}
',
        ]);
    }
}
