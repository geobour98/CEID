#include <stdio.h>
#include <stdlib.h>
#include <signal.h>
#include <sys/types.h>
#include <unistd.h>
int main()
{
	int pid1;
	int pid2;
	pid1 = fork();
	if(pid1 < 0)
		printf("Could not create any child\n");
	else
	{
		pid2 = fork();
		if(pid2 < 0)
			printf("Could not create any child\n");
		else
		 if((pid1 < 0) && (pid2 < 0)) kill(pid1,9);
	}
	printf("To id tou gonea einai: %d kai to id ths diergasias einai: %d\n",getppid(),getpid());
	sleep(20);
	return (0);
}
