#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <unistd.h>

int main(){	
	int pid; 
	//xrhsimopoihsame enallaktika tous kyklous ths CPU me th synarthsh clock() kai thn stathera CLOCKS_PER_SEC	
	clock_t start, end;
	double cpu_time_used;
	pid = fork();
	int  i=0;
	int status;	
	start = clock();	
	while(i<100) {
		if(pid>0){
			waitpid(-1, &status, 0);			
			printf("waitpid by parent\n");			
		}
		else {					
			printf("%3i (child) - ", i);
			foo(i);
			printf("Foo result: %d\n", foo(i));
		}		
		i++;
	}
	printf("Arxikos xronos deyteroleptwn: %lf\n", start);	
	end = clock();
	cpu_time_used = ((double) (end - start)) / CLOCKS_PER_SEC;
	printf("Mesos xronos diergasias: %lf\n", cpu_time_used/100);
	printf("Synolikos xronos deyteroleptwn: %lf\n", cpu_time_used);
return 0;
}

int foo(int x){
	int res;	
	res=x+10;
	return res;
}
