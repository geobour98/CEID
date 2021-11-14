#include <stdlib.h>
#include <unistd.h>
#include <stdio.h>

int main() 
{
	int i, pid;

	pid = fork();
 
	if(pid>0) 
	{
		return(0);
	}
	else {
		for(i=0; i<10; i++) 
		{						
			printf("%3i: child\n",i);
		}
	return (0);
	}
}
