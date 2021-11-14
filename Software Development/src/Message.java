
public class Message {
    
    private int code;
    
    private String date;
    
    private String hour;
    
    private String username_sender;
    
    private String username_receiver;
    
    private String title;
    
    private String content;
    
   public Message(int code,String date, String hour, String username_sender, String username_receiver, String title, String content )
           
   {  
       this.code = code;
       this.date = date;
       
       this.hour = hour;
       
       this.username_sender = username_sender;
       this.username_receiver = username_receiver;
       
       this.title = title;
       this.content = content;
   }
   
   
   int get_code()
           
   {
    return code;   
   }
   
   String get_date()
           
   {
       
    return date;   
   }
   
   String get_hour()
           
   {
       
    return hour;   
   }
   
String get_sender()
        
{
    return username_sender;
}
   
String get_receiver()
        
{
    
 return username_receiver;   
}

String get_title()
        
{
    return title;
}

String get_content()
        
{
    
 return content;   
}
    
void send_message(Message m)
{
     ArrayList<Message> temp = new ArrayList<Message>();
            
     temp.add(m);
}

}




   
    

