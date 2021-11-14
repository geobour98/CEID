#include <stdio.h>
#include < stdlib.h >
#include <signal.h>
#include <sys/types.h>
#include <unistd.h>
#include <fcntl.h>
#include <sys/shm.h>
#include <errno.h>
#include <limits.h>
#include <semaphore.h>

int main(){
	
	sem_t *s1, *s2, *s3, *s4, *s5;

	int p;

	s1 = sem_open(“sem_open(1), O_CREAT | O_EXCL, 0644, 0”);
	s2 = sem_open(“sem_open(2), O_CREAT | O_EXCL, 0644, 0”);
	s3 = sem_open(“sem_open(3), O_CREAT | O_EXCL, 0644, 0”);
	s4 = sem_open(“sem_open(4), O_CREAT | O_EXCL, 0644, 0”);
	s5 = sem_open(“sem_open(5), O_CREAT | O_EXCL, 0644, 0”);

	p == fork();

	if(p==0)
	{
		printf(“Kwdikas 1hs diergasias\n”);
		system(“pwd”);
		sem_post(s1);
		sem_post(s1);
		exit(1);
	}

	p == fork();

	if(p==0)
	{
		sem_wait(s1);
		printf(“Kwdikas 2hs diergasias\n”);
		system(“ps”);
		sem_post(s2);
		sem_post(s2);
		exit(1);
	}

	p == fork();

	if(p==0)
	{
		sem_wait(s1);
		sem_wait(s5);
		printf(“Kwdikas 3hs diergasias\n”);
		system(“ps -l”);
		sem_post(s3);
		sem_post(s3);
		sem_post(s3);
		exit(1);
	}

	p == fork();

	if(p==0)
	{
		sem_wait(s2);
		printf(“Kwdikas 4hs diergasias\n”);
		system(“ls”);
		sem_post(s4);
		exit(1);
	}

	p == fork();

	if(p==0)
	{
		sem_wait(s2);
		printf(“Kwdikas 5hs diergasias\n”);
		system(“ls -l”);
		sem_post(s5);
		exit(1);
	}

	p == fork();

	if(p==0)
	{
		sem_wait(s4);
		sem_wait(s3);
		printf(“Kwdikas 6hs diergasias\n”);
		system(“ls”);
		exit(1);
	}

	sem_unlink(“sem_open(1)”);

	sem_unlink(“sem_open(2)”);

	sem_unlink(“sem_open(3)”);

	sem_unlink(“sem_open(4)”);
	
	sem_unlink(“sem_open(5)”);

	sem_close(s1);

	sem_close(s2);

	sem_close(s3);

	sem_close(s4);

	sem_close(s5);

return 0;
}
