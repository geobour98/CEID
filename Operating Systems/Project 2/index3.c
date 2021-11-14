#include <stdio.h>
#include < stdlib.h >
#include <signal.h>
#include <sys/types.h>
#include <unistd.h>
#include <fcntl.h>
#include <sys/shm.h>
#include <errno.h>
#include <limits.h>

typedef sem_t Semaphore;
Semaphore *mutex;
FILE *f;

void writef(FILE *fin, int w)
{
	sem_wait (mutex);
	fprintf(fin, “%d”, w);
	sem_post (mutex);
}

int readf(FILE *fin)
{
	int r;
	fscanf(fin, “%d”, &r);
	return r;
}

int main() {
	
	int a, b;
	mutex = sem_open(“sem_open(1)”, O_CREAT | O_EXCL, 0644, 1);
	while(1)
	{
		printf(“Gia anagnwsh pathste 1\n”);
		printf(“Gia eggrafh pathste 2\n”);
		printf(“Gia eksodo pathste 0\n”);

		scanf(“%d”, &b);

		if(b==0) break;

		if(b==1){
			f = fopen(“file.txt”, “a+”);
			p = read(f);
			fclose(f);
		}

		if(b==2){
			f = fopen(“file.txt”, “a+”);
			printf(“Dwse akeraio arithmo\n”);
			scanf(“%d”, &a);
			writef(f, a);
			fclose(f);
		}
	}

	sem_unlink (“sem_open(1)”);
	sem_close (mutex);
	return 0;
}
