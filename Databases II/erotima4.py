import findspark
import time


import pyspark 
from pyspark.sql import SparkSession
from pyspark.context import SparkContext
import pyspark.sql.functions as f


findspark.init() 
sc=SparkSession \
    .builder \
    .appName("er4") \
    .getOrCreate()
    

df1 = sc.read.csv('movie.csv', header='true')
df2 = sc.read.csv('tag.csv', header='true')
df3 = sc.read.csv('rating.csv', header='true')
df4 = sc.read.csv('genome_tags.csv', header='true')

df1.createOrReplaceTempView("movie")
df2.createOrReplaceTempView("tag")
df3.createOrReplaceTempView("rating")
df4.createOrReplaceTempView("genome_tags")
df1.show(3)
df2.show(3)
df3.show(3)
df4.show(3)


df5=df1.select("movieId","title",f.posexplode(f.split("genres", "\|")).alias("pos", "categ"))
df5.createOrReplaceTempView("cat")
df6=sc.sql("select distinct categ from cat")
df6.show()
df5.createOrReplaceTempView("category")


start_time = time.time()
for y in range(2005,2016):
	s3=sc.sql("select year(timestamp),movie.title from movie,rating where movie.movieId=rating.movieId and year(timestamp)="+str(y)+" order by rating desc").limit(10)
	s3.show()
end_time=time.time()
total_time=end_time-start_time

print("TIME=%d" %total_time)
