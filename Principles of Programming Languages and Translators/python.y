%{
#include <stdio.h>
#include <stdlib.h>


FILE *yyin;

void yyerror(const char *e);

int yylex();
extern char* yytext();
extern int counter;


%}
%token NEWLINE

%token IMPORT
%token INPUT
%token PRINT
%token RAW_INPUT
%token IF
%token DEF
%token RETURN 
%token CLASS

%token LAMBDA
%token FOR

%token OR
%token AND

%token ITEMS
%token IN

%token RANGE
%token SETDEFAULT

%token QUAT

%token NUMBER2
%token FLOAT
%token INDENTIFIER
%token OBJECT
%token STRNG


%%
code: ainput | code ainput ;
ainput: NEWLINE | cmd_imp  | classes | defs  |  cmd_pr | cmd_in 
			| if | for | assigns | returns | comms;
cmd_imp: IMPORT text_more ;
cmd_pr: PRINT '(' mores ')' ;

cmd_in: INDENTIFIER '=' INPUT '(' STRNG ')' | INDENTIFIER assigns RAW_INPUT '(' STRNG ')' 
	OBJECT '=' INPUT '(' STRNG ')' | OBJECT '=' RAW_INPUT '(' STRNG ')';
classes: CLASS INDENTIFIER ':' NEWLINE ainput;
defs: defs1 NEWLINE ainput;
returns:  RETURN expr;

defs1:  DEF INDENTIFIER '(' ')' ':' | DEF INDENTIFIER '(' text_more ')' ':' ;
if: IF cont ':' NEWLINE ainput;
for: FOR INDENTIFIER IN RANGE '(' expr ')' ':' NEWLINE ainput |
	FOR INDENTIFIER IN INDENTIFIER ':' NEWLINE ainput;
	
assigns: INDENTIFIER '=' expr | INDENTIFIER '=' lambda;

lambda: LAMBDA text_more ':' expr;

expr: 	types | list | dicts 
		| cmd_dicts | expr operator types | '(' expr ')' ;
list: '[' mores ']';
dicts: '{' vals '}';
cmd_dicts: INDENTIFIER '.' SETDEFAULT vals | INDENTIFIER '.' ITEMS '(' ')';
vals: val | vals ',' val;

val: '(' QUAT INDENTIFIER QUAT ':' QUAT expr QUAT ')';
text_more: INDENTIFIER | text_more ',' INDENTIFIER;
mores:  types | mores ',' types ;

types: STRNG | INDENTIFIER | NUMBER2 | FLOAT |OBJECT  ;
cont: expr operator_cont expr | '(' cont ')' | cont AND expr | cont OR expr;
operator: '+' | '-' | '*' | '/' | '%';
operator_cont:  '>' | '<' |'!''=' | '=''=' | '>''='| '<''=';

comms: '#' types operator NEWLINE; 

%% 


int main(int argc, char* argv[]) {
	FILE *file;
	if (argc>1)
	{
		file = fopen(argv[1], "r");
		if (!file) {
			printf("ERROR %s \n",argv[1]);
			exit(1);
		}
		yyin = file;
	}
	else
	{ yyin = stdin; }
	
	yyparse();
	printf("\nEND PARSER\n");

}

void yyerror(const char *e) {
	printf("!!! ERROR . LINE ERROR : %d\n",counter);
	
}
