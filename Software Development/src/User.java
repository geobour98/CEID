import java.util.*;
public class User {
    
    private String username;
    private String password;
    private String email;
    private String photopath;
    ArrayList<Reservation> my_reservations = new ArrayList<Reservation>();
    ArrayList<Book> my_books = new ArrayList<Book>();
    
    public User(String username, String password, String email, String photopath)
    {
        this.username = username;
        this.password = password;
        this.email = email;
        this.photopath = photopath;
        
    }
    
    public String get_username()
            
    {
        return username;
    }
    
    public String get_password()
            
    {
     return password;   
    }
    
    public String get_email()
            
    {
        return email;
    }
    
   public String get_photo_path()
           
   {
       
    return photopath;   
   }
   
   
         
public void remove_my_books(Book b)
{
my_books.remove(b);
}
         
   
   ArrayList<Book> search_book_title(String s)
           
   {
       
       ArrayList<Book> temp = new ArrayList<Book>();
       
       int flag = 0;
     for(Book b: Main.booklist)
         
     {
         
         if(b.get_title().equals(s))
         {
             temp.add(b);
         }
     }
          return temp; 
   }
   
   

 ArrayList<Book> find_book_author(String a)
{
    ArrayList<Book> temp = new ArrayList<Book>();
    int flag = 0;
     for(Book b: Main.booklist)
   {
       if(b.get_author().equals(a))
       {
           temp.add(b);
        }
    }
       return temp; 
   }
   
   
   
ArrayList<Book> search_book_category(String s)
{
   ArrayList<Book> temp = new ArrayList<Book>();
   int flag = 0;
   for(Book b: Main.booklist)
   {
        if(b.get_category().get_name().equals(s))
        {
            temp.add(b);
         }
    }
        return temp; 
   }
   

   
   public void sumbit_review(Book b,String content)
   { 
       for (Book b:Main.booklist)
       if (b.get_review.get_isbn().equals(isbn))
       {
           Main.reviewlist.add(content);
       }
   }
   
  
  public void delete_account()
  {
       for( User u: Main.userlist)
       {
       if (u.get_username().equals(username))
		{
			Main.userlist.remove(u);
        }
       
		} 
   }
   
  
public void cancel_reservation(String username)
{
   for( Reservation r: Main.reservationlist)
    {   
       if(r.get_username().equals(username))
       {  
           Main.reservationlist.remove(r);
       }
       
   }
   
}
  
     
   
ArrayList<Reservation> view_reserved_books ()
{   
    ArrayList<Reservation> temp = new ArrayList<Reservation>();
    int flag = 0;
       for(Reservation r: Main.reservationlist)
        {
         
            if(r.get_username().equals(username))
            {
                temp.add(r);
            }
       }
          return temp; 
} 
   
   
ArrayList<Message> view_messages()
{
    ArrayList<Message> temp = new ArrayList<Message>();
            int flaf=0;
  
        for(Message m: Main.usermessagelist)
        {
            
            if(m.get_receiver().equals(username))
            {
                 temp.add(m);
            }
  
        
            return temp;
        }
  
}  
  


ArrayList<Booking> view_user_history(String username,String isbn)
{
    ArrayList<Booking> temp = new ArrayList<Booking>();
    int flag=0;
   
    for(Booking b:Main.bookinglist)
    {
    
        if(b.get_username().equals(username))
        {
            temp.add(b);
        }
    }
    
    return temp;
}



ArrayList<Book> order_by_rating()
{
    ArrayList<Book> temp = new ArrayList<Book>();
    int flag=0;
    for(Book b :Main.booklist)
    {
    booklist.sort(Comparator.comparing(Book::get_average_rating));
    }
    return temp;
}
ArrayList<Book> order_by_title()
{
    ArrayList<Book> temp= new ArrayList<Book>();
    int flag=0;
    for(Book b: Main.booklist)
    {
    bookist.sort(Comparator.comparing(Book::get_title));
    }
return temp;

}



}
