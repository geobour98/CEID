import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;

public class Administrator {
    
    private String username;
    private String password;
    private String email;
    ArrayList<Book> adbook = new ArrayList<Book>(); 
    ArrayList<Category> categ = new ArrayList<Category>();
    
    public Administrator(String username, String password, String email)
            
    {
    this.username = username;
    this.password = password;
    this.email = email;
    }
    public  Administrator(){}
    
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


    public void delete_user(User u)
    {
        Main.userlist.remove(u);
    }   
    
    
    
    public void send_message(Message m,User u)
    {
         ArrayList<Message> temp = new ArrayList<Message>();
            
         temp.add(m);
    }
     ArrayList<Book> search_book_title_Adm(String s)
           
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
    

public void add_categ(Category m ){

    
categ.add(m);

}

public void del_categ(Category m ){

    
categ.remove(m);

}


public void add_book(Book m ){
   Main.booklist.add(m); 

}
public void del_book(Book m ){
   Main.booklist.remove(m); 

}
public void search_book(String m ){
   Main.booklist.remove(m); 

}
  ArrayList<Book> search_book_by_title(String s)
           
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
  
    ArrayList<Book> search_book_by_category(String s)
           
   {
       
       ArrayList<Book> temp = new ArrayList<Book>();
       
       int flag = 0;
     for(Book b: Main.booklist)
         
     {
         
         if(b.get_category().equals(s))
         {
             temp.add(b);
         }
     }
          return temp; 
   }
public void verify_reservetion(Reservation m,User u){
 
    Main.reservationlist.remove(m); 
    

}   
    
public void reset(Category m ){

      adbook = Main.booklist;
} 
    
    
ArrayList<Book>Sort_by_rating(){
 
       Collections.sort(adbook , new Comparator<Book>() {
           @Override
           public int compare(Book t, Book t1) {
           return t.get_average_rating().compareTo(t1.get_average_rating());
           
           }
       });
    return adbook;

}    
    
 public void cancel_reservations(Reservation m){
     // bookings
    Main.reservationlist.remove(m); 
    
}      
    
    
ArrayList<Book> Filter_by_booktitle(String s)
           
   {
      Book booko = new Book();
     
       
       ArrayList<Book> tempBook = new ArrayList<Book>();
     for(Reservation b: Main.reservationlist)
         
     {
       
         if(b.getbook().get_title().equals(s))
         {
            booko = b.getbook();
         }
         tempBook.add(booko);
     }
             
          return tempBook; 
   }
    
    
   public void Sort_reservetions_by_date(){
 
       Collections.sort( Main.reservationlist ,new Comparator<Reservation>() {
           @Override
           public int compare(Reservation t, Reservation t1) {
           return t.get_date().compareTo(t1.get_date());
           
           }
       }); 
    User search_User(String s){

    User temp = new User();
    for(User b: Main.userlist)
         
     {
         
         if(b.get_username().equals(s))
         {
            temp = b;
         }
        
     }

return temp; 

}
public void del_book(String m ){
   
    
       
     Book temp = new Book();
       
       
     for(Book b: Main.booklist)
         
     {
         
         if(b.get_isbn().equals(m))
         {
             temp=b;
         }
     }
   adbook.remove(temp);
   Main.booklist.remove(temp); 

}       
      
}
