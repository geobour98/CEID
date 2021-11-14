#include <stdio.h>
#include < stdlib.h >
#include <signal.h>
#include <sys/types.h>
#include <unistd.h>
#include <fcntl.h>
#include <sys/shm.h>
#include <errno.h>
#include <limits.h>

struct heapShared{
	int heap[100000];
	int heapSize;
} *sharedHeap;

void run(){
	int cur = sharedHeap->heapSize;
	sharedHeap->heapSize++;
	sharedHeap->heap[sharedHeap->heapSize] = object;
	while(sharedHeap->heap[cur/2] > object){
		cur = cur/2;
	}
	sharedHeap->heap[cur] = object;
}

typedef sem_t Semaphore;

Semaphore *mutex;

int main() {
	int a=0, t, p, s, val;
	key_t keys;
	mutex = sem_open("Sem", O_CREAT | O_EXCL, 0644, 1);
	keys = ftok("/dev/null", 4);
	s = shmget(keys, sizeof(struct heapShared), 0644 | IPC_CREAT);
	if(s < 0){
		perror("shmget\n");
		exit(1);
	}
	sharedHeap = (struct heapShared*) shmat (s , NULL, 0);
	run();
	while(a < 10){
		p = fork();
		if(p==0){
			srand(clock());
			rs = rand()%100;
			sem_wait(mutex);
			put(rs);
			sem_post(mutex);
			exit(0);
		}
		a++;
	}while ((p) = waitpid(-1, &val, 0)) != -1);
	a = 0;
	while (a < 10){
		printf("%d", sharedHeap->heap[a]);
		a++;
	}
	shmdt (sharedHeap);
	shmctl (s, IPC_RMID, 0);
	sem_unlink ("Sem");
	sem_close(mutex);
	return(0);
}
