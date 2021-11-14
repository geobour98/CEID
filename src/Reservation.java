
public class Reservation {
    
    private int code;
    
    private String isbn;
    
    private String username;
    
    private boolean status;
    
    private String date;
    private String hour;
    
    
    public Reservation(int code, String isbn, String username, boolean status, String date, String hour)
            
    {
    
    this.code = code;
    this.isbn = isbn;
    this.username = username;
    
    this.status = status;
    this.date = date;
    
    this.hour = hour;
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
boolean get_status()
        
{
    return status;
}

String get_date()
        
{
    
 return date;   
}

String get_hour()
        
{
 return hour;   
}
}
    

