import findspark
import time


import pyspark 
from pyspark.sql import SparkSession
from pyspark.context import SparkContext
import pyspark.sql.functions as f


findspark.init() 
sc=SparkSession \
    .builder \
    .appName("er9") \
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
s3=sc.sql("select count(*) from rating as r1, rating as r2 where r1.userId<>r2.userId and r1.movieId=r2.movieId and hour(r1.timestamp)=hour(r2.timestamp) and date(r1.timestamp)=date(r2.timestamp) ")
s3.show()
end_time=time.time()
total_time=end_time-start_time

print("TIME=%d" %total_time)
