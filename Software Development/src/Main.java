import java.util.*;
import java.util.Comparator;


public class Main {
    
    
    public static ArrayList<User> userlist = new ArrayList<User>();
    public static ArrayList<Administrator> adminlist = new ArrayList<Administrator>();
    public static ArrayList<Message> usermessagelist= new ArrayList<Message>();
    public static ArrayList<Message> viewsentmessages = new ArrayList<Message>();
    public static ArrayList<Book> booklist = new ArrayList<Book>();
    public static ArrayList<Booking> bookinglist = new ArrayList<Booking>();
    public static ArrayList<Reservation> reservationlist = new ArrayList<Reservation>();
    public static ArrayList<Review> reviewlist = new ArrayList<Review>();
    public static ArrayList<Category> categorylist= new ArrayList<Category>();
    
    
    public static void main(String args[])
            
            
    {
        
   
   User user1 = new User("nikos","1234","nik@gmail.com", "path1");
   User user2 = new User("anastasia","0123","anast@gmail.com","path2");
        
   userlist.add(user1);
   userlist.add(user2); 
        
   Administrator admin1 = new Administrator("giorgos", "12345", "giorgos@gmail.com");
   Administrator admin2 = new Administrator("antwnis","5678","ant@gmail.com");
        
   adminlist.add(admin1);
    adminlist.add(admin2);
        
   Message m = new Message(1,"31-05-2020","15.45","giorgos","nikos","Ypenthymish epistrofhs biblioy","Exei lhksei h prothesmia gia thn epistrofh toy biblioy");
   
   viewsentmessages.add(m);
   
        
   Category cat1 = new Category("novel",5);
   Category cat2 = new Category("literature",4);
   Category cat3 = new Category("science fiction",25);     
        
   categorylist.add(cat1);
   categorylist.add(cat2);
   categorylist.add(cat3);
   
   Review re1 = new Review(12,"nikos","123","15.04.2020","48","4");
   reviewlist.add(re1);
   
   Book b1 = new Book("123","The Man","Panagiotou",cat2,"345",re1,7.5);
   booklist.add(b1);
   
   Booking kra1= new Booking(23, "giorgos", "123", "5.6.2020" , "67" ,45);
   bookinglist.add(kra1);
        
        
        
        
   HomePage page1 = new HomePage();
   
   page1.setVisible(true);
   
   
        
    }
   
   public static User get_user(String username)
           
   {
       User temp=null;
       
       for(User u: Main.userlist)
           
       {
           
           if(u.get_username().equals(username))
           {
               temp = u;
           }
       }
       
       return temp;
   }
   
   
   
   public static Administrator get_admin(String username)
           
   {
       Administrator temp=null;
       
       for(Administrator a: Main.adminlist)
           
       {
           
           if(a.get_username().equals(username))
           {
               temp = a;
           }
       }
       
       return temp;
   }
    
    public void delete_book(Book b)
    {
        Main.booklist.remove(b);
    } 
   public void cancel_reservation(Reservation r)
    {
        Main.reservationlist.remove(r);
    } 
   public void verify_reservation(Reservation r)
    {
        Main.reservationlist.add(r);
    }
    
    public static Book get_book(String title)
      
   {
       Book temp= null;
       
       for(Book b : Main.booklist)
       {
           if(b.get_title().equals(title))
           {
               temp = b;
           }
       }
       
       return temp;
   }
    public static Category get_category(String name)
   {
       Category temp= null;
       
       for(Category c : Main.categorylist)
       {
           if(c.get_name().equals(name))
           {
               temp = c;
           }
       }
       
       return temp;
   }
    
   public void send_message(Message m)
   {
        ArrayList<Message> temp = new ArrayList<Message>();
            
            temp.add(m);
   }

   
    
}
