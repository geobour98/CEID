#include <stdio.h>
#include <stdlib.h>
#define  N  10

int main()
{
	int i;
	int pid;

	for (i=0; i<N; i++)
	{
		pid = fork();
		
		if (pid > 0)
		{
			printf(" Father = %5i, Id = %5i, Child = %5i\n", getppid(), getpid(), pid);
			wait(NULL);
			break;
		}
	}
	return (0);
}
