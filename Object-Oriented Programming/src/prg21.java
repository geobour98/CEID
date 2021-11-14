package prg21;

import java.sql.Timestamp;
import java.util.*;
import java.util.Scanner;


class User
{
    String email;
    String password;
    String onoma;
  
    List ReqFriends=new ArrayList();
    List Friends=new ArrayList();
    
    Wall W;
    
    
    User()
    {
        email="";
        password="";
        onoma="";
        
    }
    
    void set(String eml, String pss, String on)
    {
        email=eml;
        password=pss;
        onoma=on;
        W=new Wall(this);
        
    }
    
    String geteml()
    {
        return email;
    }
    
    
    String getpss()
    {
        return password;
    }
    
    @Override
    public String toString()
    {
        return "Email:"+email+" Onoma:"+onoma;
    }
    
    
    void getFriends()
    {
        int i=0;
        for (Object Friend : Friends) {
            
            User U;
            U = (User) Friend;
            System.out.println(i+". "+U.toString());
        }
    }
}

class FriendRequest
{
    User user1,user2;
    Timestamp timestamp;
    int state;  // 1. accept, 2. reject, 3 pending
    
    FriendRequest(User u1, User u2)
    {
        user1=u1;
        user2=u2;
        timestamp= new Timestamp(System.currentTimeMillis());;
        state=3;
    }
    
    void accept(int s)
    {
        state=1;
        
    }
    
    void reject(int s)
    {
        state=2;
    }

    void show()
    {
        System.out.println(user2.toString());
    }
}


class Wall
{
    List Posts=new ArrayList();
    User U;
    Wall (User u)
    {
        U=u;
    }
    
    void newPost(User u2)
    {
        Message m=new Message();
        m.create(u2);
        Posts.add(m);
    }
    
    void getList()
    {
        int i=0;
        for (Object Post : Posts) {
            Message m;
            m=(Message) Post;
            System.out.println(i+". " +m.toString());
            i++;
        }
        
    }
    
    void Show()
    {
        System.out.println("My Posts");
        System.out.println("-----------");
        getList();
        System.out.println("\n Friends Posts");
        System.out.println("-----------");
        for (Object F: U.Friends)
        {
            User uu;
            uu=(User) F;
            uu.W.getList();
        }
        
        
        
    }
  
   
    
}

class Message
{
    String text;
    User u=new User();
    Timestamp timestamp;
    List Likes=new ArrayList();
    List ReplyMsg=new ArrayList();
    Message()
    {
        
    }
    
    void create(User u1)
    {
        u=u1;
        Scanner in=new Scanner(System.in);
        
        System.out.println("give message:");
        text=in.nextLine();
        Timestamp timestamp = new Timestamp(System.currentTimeMillis());
    }
    
    @Override
    public String toString()
    {
        String s;
        s= text+" time:"+timestamp.toString()+" Likes:"+getNumofLikes();
        for (Object R : ReplyMsg) {
            Message mm=(Message) R;
            s=s+"\n "+text;
        }
        return s;
    }
  
    void showLikes()
    {
        System.out.println("Likes from:");
        String s="";
         for (Object Like : Likes) {
            User uu=(User) Like; 
            s=s+"\n like from:"+uu.geteml();
        }
        System.out.println(s);
    }
    
    void reply(User u2)
    {
        Message m2=new Message();
        m2.create(u2);
        
        ReplyMsg.add(m2);
    }
    
    void like(User u2)
    {
        int f=0;
        if(Likes.contains(u2))
        {
            
            System.out.println("You already made like");
        }
        else
        {
            Likes.add(u2);
        }
    }
    
    int getNumofLikes()
    {
        return Likes.size();
    }
    

}


class Network
{
    List Usrs=new ArrayList();
    
    Network()
    {
        
    }
    
    void insertUser(User u)
    {
        Usrs.add(u);
        
    }
    
    User findUser(User u)
    {
       for (int i=0;i<Usrs.size();i++)
       {
           if(Usrs.get(i)==u)
           {
              return u; 
           }
       }
       return null;
    }
    
     User findUser(String eml, String pss)
    {
       for (int i=0;i<Usrs.size();i++)
       {
           User u=(User) Usrs.get(i);
           if(u.geteml().equals(eml) && u.getpss().equals(pss))
           {
              return u; 
           }
           
       }
       return null;
    }
    
    void delUser(User u)
    {
        Usrs.remove(u);
    }
    
   
}


class Menu
{
    int ch;
    User u;
    Network N;
    Menu(User u1,Network n2)
    {
      ch=0;
      u=u1;  
      N=n2;
        
    }
    
    void show()
    {
        System.out.println("1. See your Wall");
        System.out.println("2. See Friends Wall");
        System.out.println("3. See Friends Request");
        System.out.println("4. Accept/Reject friend request");
        System.out.println("5. See my friends");
        System.out.println("7. Logout");
        System.out.println("8. Exit");
        
        Scanner in=new Scanner(System.in);
        ch=in.nextInt();
        
        
        
    }
    
    int run_method()
    {
        Scanner in=new Scanner(System.in);
        if(ch==1)
        {
          
            u.W.Show();
            System.out.println("New Post?");
            String f=in.nextLine();
            if (f.equals("Y"))
            {
                u.W.newPost(u);
            }
        }
        
        if(ch==2)
        {
            System.out.println("Your Friends");
            u.getFriends();
            
            System.out.println("Give a number:");
            int f=in.nextInt();
            System.out.println("1. New Post");
            System.out.println("2. Reply Message");
            System.out.println("3. Like");
            System.out.println("Give a Choice:");
            int ch2=in.nextInt();
            
            User U2=(User) u.Friends.get(f);
            if(ch2==1)
            {
                U2.W.newPost(U2);
            }
            if(ch2==2)
            {
                U2.W.getList();
                
                    System.out.println("Give a number:");
                    int mm=in.nextInt();
                Message m;
                m=(Message) U2.W.Posts.get(mm);
                m.reply(u);
            }
            if(ch2==3)
            {
                U2.W.getList();
                
                    System.out.println("Give a number:");
                    int mm=in.nextInt();
                Message m;
                m=(Message) U2.W.Posts.get(mm);
                m.like(u);
            }
            
         
        }
        
        if(ch==3)
        {
            int i=0;
            for (Object F: N.Usrs)
            {
                User ff=(User) F;
                if (!u.Friends.contains(ff))
                {
                    System.out.println(i+" "+ff.toString());
                }
                i++;
            }
            
               System.out.println("Give a number:");
               int f=in.nextInt();
               User u2;
               u2=(User) N.Usrs.get(f);
               FriendRequest rq=new FriendRequest(u, u2);
               u2.ReqFriends.add(u);
            
        }
        
        if(ch==4)
        {
            int i=0;
            for (Object R: u.ReqFriends)
            {
                FriendRequest rq=(FriendRequest) R;
                System.out.println(i+". "+rq.user2.toString());
                i++;
            }
            
               System.out.println("Give a number:");
               int f=in.nextInt();
               System.out.println("1. Accept, 2. Reject");
               int x=in.nextInt();
               
               FriendRequest rq2=(FriendRequest) u.ReqFriends.get(f);
               if(x==1)
               {
                   u.ReqFriends.remove(rq2);
                   u.Friends.add(rq2.user2);
                   rq2.user2.Friends.add(rq2.user1);
                   
               }
               else
               {
                   u.ReqFriends.remove(rq2);
                   
               }
        }
        if(ch==5)
        {
            u.getFriends();
        }
        
        return ch;
    }
    
}

class IncorrectFileNameException extends Exception { 
    public IncorrectFileNameException(String errorMessage) {
        super(errorMessage);
    }
}


public class Prg21 {

Network N;
  
    public static void main(String[] args) {
        User U=new User();
        Network N=new Network();
        
        int login=0;
        
        Scanner in=new Scanner(System.in);
        
        
        
       
       
        while(true)
        {
            
            
            if (login==0)
            {
                System.out.println("Do you want to create an account?");
                String yn=in.nextLine();
                
                if(yn.equals("Y"))
                {
                    System.out.println("Give Email:");
                    String eml=in.nextLine();
                    System.out.println("Give Password:");
                    String pss=in.nextLine();
                    System.out.println("Give Onoma:");
                    String on=in.nextLine();
                    
                    User u2=new User();
                    u2.set(eml, pss, on);
                    
                    N.insertUser(u2);
                }
                
                System.out.println("Login ");
                System.out.println("------------------------");
                System.out.println("Email:");
               
                String usr=in.nextLine();
                System.out.println("Password:");
                String pss=in.nextLine();
                
                U=N.findUser(usr, pss);
                if (U!=null)
                {
                    login=1;
                    
                }
                else
                {
                    System.out.println("Not Found User");
                    
                }
                
            }
            
            
            if(login==1)
            {
                Menu M=new Menu(U,N);
                System.out.println("Login User="+U.onoma+" email:"+U.email);
                 M.show();
                int ch=M.run_method();
               
                if (ch==7) login=0;
                if (ch==8) break;
            }
        }
    }
    
}
