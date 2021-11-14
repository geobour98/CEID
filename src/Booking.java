
public class Booking {
    
    private int code;
    private String username;
    private String isbn;
    private String date;
    private String hour;
    int duration;
    
   public Booking(int code, String username, String isbn, String date, String hour, int duration)
           
   {
    this.code = code;   
    this.username = username;
    this.isbn = isbn;
    
    this.date = date;
    
    this.hour = hour;
    this.duration = duration;
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
   

int get_duration()
        
{
    return duration;
    
}

   
   }
    
    

