%option noyywrap
%{

#include <stdio.h>
#include "python.tab.h"

int counter = 1;

%}


%%
[ ] ;
[\n] {counter++; return NEWLINE;};

"import"  return IMPORT;
"input"   return INPUT;
"print" return PRINT;
"raw_input"  return RAW_INPUT;
"if" return IF;
"def" return DEF;
"return" return RETURN;
"class" return CLASS;

"lambda" return LAMBDA;
"for" return FOR;

"or" return OR;
"and" return AND;

"items" return ITEMS;
"in" return IN;

"range" return RANGE;
"setdefault" return SETDEFAULT;

"\"" return QUAT;

"<" return '<';
"[" return '[';
"]" return ']';
")" return ')';
">" return '>';
"{" return '{';
"}" return '}';

"+" return '+';
"/" return '/';
"(" return '(';
";" return ';';
"," return ',';
"%" return '%';
":" return  ':';

"!" return '!';
"-" return '-';
"*" return '*';
"=" return '=';
"#" return '#';

[0-9][0-9]* 			{ return NUMBER2; }
[0-9]+"."[0-9]+ 		{ return FLOAT; }
[a-zA-Z_][a-zA-Z0-9_]*		{return INDENTIFIER;}
[a-zA-Z_][a-zA-Z0-9_]*"."[a-zA-Z_][a-zA-Z0-9_]*		{return OBJECT;}
\"[^'\n]*\" 			{ return STRNG; } 

%%
