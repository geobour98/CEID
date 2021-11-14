/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author 7_USER
 */
public class Review {

private int code;

private String username;

private String isbn;

private String date;

private String hour;

private String content;



public Review(int code, String username, String isbn,String date, String hour, String content )
        
{
 this.code = code;
 
 this.username = username;
 
 this.isbn = isbn;
 
 this.date = date;
 
 
 this.hour = hour;
 
 this.content = content;
}


int get_code()
           
   {
    return code;   
   }


String get_isbn()
        
{
    return isbn;
    
}

String get_username()
        
{
    
return username;    
}

   
   String get_date()
           
   {
       
    return date;   
   }
   
   String get_hour()
           
   {
       
    return hour;   
   }
   

   




String get_content()
        
{
    
 return content;   
}


    
}
