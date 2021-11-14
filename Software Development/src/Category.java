
public class Category {
    
    private String name;
    private int count;
    
    public Category(String name, int count)
            
    {
    this.name = name;
    this.count = count;
    }
    
   String get_name()
           
   {
    return name;   
   }
   
   int get_count()
           
   {
    return count;   
   }
   public  void get_name(Category  c)

   {
    Main.categorylist.remove(c);
   
   }
   
   
   public int get_sum_of_books (String name){
          
        int flag=0;
        for(Book b: Main.booklist)
        
        {
             if(b.get_category().name.equals(this.name))   
            {
               flag ++;
             }
            
        }
           return flag;
        
    }
   
   
   
   ArrayList<Book> get_category_books()
   {
   ArrayList<Book> temp = ArrayList<Book>();
   int flag=o;
   
   for (Book b:Main.booklist)
   {
       if(b.get_category().name.equals(this.name))
       {
       
             temp.add(b);
       }
   
   
   }
   return temp;
  }
   
   
   
   
}



 
