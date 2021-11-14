#include <stdio.h>
#include <malloc.h>
#include <time.h>
#include <omp.h>


struct List {
  
int N; 
int *P; 
  	

} *S, *L;

void SetLists(int MaxLength)
{
	L=(struct List *) malloc(sizeof(struct List *));
	S=(struct List *) malloc(sizeof(struct List *));
	
	L->P=(int *) malloc(sizeof(int)*MaxLength);		
	L->N=0;	

	S->P=(int *) malloc(sizeof(int)*MaxLength);		
	S->N=0;	


}


int find(struct List *lst, int x)
{
	for (int i=0;i<lst->N;i++)
	{
		if(lst->P[i]==x) 
		{ 
			return i;
		}
	}	
	return -1;

}


void push(struct List *lst, int x )
{
	
	if(find(lst,x)==-1) 
	{
		lst->P[lst->N++]=x;
	}
	
};


int pop(struct List *lst)
{
	if(lst->N!=0)	
		return lst->P[--lst->N];

	return -1;
}


void showSort()
{
	
	for (int i=0;i<L->N;i++)
	{
		printf("%d ",L->P[i]);
	}

	printf("\n");
}


struct Graph
{	
	int **Pinakas_gitniasis;
	int N;

} *G;



void setG(int N)
{
	G=(struct Graph *) malloc(sizeof(struct Graph));

	G->N=N;	
	G->Pinakas_gitniasis=(int **) malloc(N*sizeof(int *));
	
	for (int i=0;i<N;i++){

	  G->Pinakas_gitniasis[i]=(int *) malloc(N*sizeof(int)); 	
	}

	for (int i=0;i<N;i++)
	{
	for (int j=0;j<N;j++)
	{
	   G->Pinakas_gitniasis[i][j]=0;	
	}
	}

}


void setedge(int node1,int node2)
{
	G->Pinakas_gitniasis[node1][node2]=1;

}


void deledge(int node1,int node2)
{
	G->Pinakas_gitniasis[node1][node2]=0;

}


int getEdge(int node1,int node2)
{
	return G->Pinakas_gitniasis[node1][node2];
}


int hasInputs(int node)
{
	
	for(int i=0;i<G->N;i++)
	{
		if( getEdge(i,node)==1) return 1;
	}
	return 0;

}


int main(int argc, char *argv[])
{
  	 
  	char fname[80];
  	
	printf("Give File: ");
	scanf("%s",fname);


	FILE *f;	
	f=fopen(fname,"r");


	int R,C,E;

	fscanf(f,"%d %d %d",&R,&C,&E);
	setG(R);

	
	for (int i=0;i<E;i++)
  	{
		int node1,node2;
		fscanf(f,"%d %d",&node1,&node2);
		setedge(node1,node2);
   	}

	fclose(f);
	
	SetLists(R);
	
  
	clock_t ts = clock();

	
	#pragma omp parallel for schedule(dynamic,1) shared(S) 
	 for (int i=0;i<G->N;i++)
	{
		
	   if(hasInputs(i)==0) { 
		
		#pragma omp critical
		push(S,i);
		  
	   }

 
	}
	
  #pragma omp parallel shared (G,S,L) 
	{	
		int nd;
		

		while(S->N!=0)
		{

			 #pragma omp critical
			 {
			 
				  nd=pop(S);
				  push(L,nd);
	
			 }
	
		  	#pragma omp parallel for  schedule(dynamic,1) shared(G,S,L,nd)  
		   	for (int i=0;i<G->N;i++)
		   	{
		      
				if(getEdge(nd,i)==1) 
				{	
					deledge(nd,i);


					if(hasInputs(i)==0)
					{
						#pragma omp critical					
						push(S,i);
					}
				}	
		   	}

		}
	
	}


	clock_t te = clock();

 	printf("The Time execute is: %10.5f seconds\n", (double)(te - ts) /(double) CLOCKS_PER_SEC);

	int sum =0;
	for (int i=0;i<G->N;i++)
	for (int j=0;j<G->N;j++) 
		sum+=getEdge(i,j);


	if(sum!=0) 
	{
	
		printf("ERROR GRAPH\n");
	}	
	else 
	{
		showSort();

	}

  return 0;
}
