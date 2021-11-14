import java.util.Collections;

public class Book {
    
    String isbn;
    String title;
    String author;
    int status ;
    String description;
   
    //status = 0 -> elefthero. status = 1 ->reserved  status = 2 ->booked
    Category category_book;
    Review book_review;
    
    double average_rating;
    
    public Book(String isbn, String title, String author, Category category_book,String description, Review book_review, double average_rating )
            
    {
        
     this.isbn = isbn;
     this.title = title;
     this.author = author;
     
     this.category_book = category_book;
     
     this.description = description;
     
     this.book_review = book_review;
        
     this.average_rating = average_rating;
    } 

    public Book() {}
    
    
    String get_isbn()
            
    {
        return isbn;
    }
    
    
    String get_title()
           
   {
        return title;
   }
   
    String get_author()
    {
        return author;   
    }

    Category get_category()
    {
        return category_book;
    }

    String get_description()
    {
        return description;
    }

    double get_average_rating()
    {
        return average_rating;   
    }

    String get_review_text()
    {
        return book_review.get_content();
    }

}






