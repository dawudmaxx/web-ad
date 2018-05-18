library(AnomalyDetection)
library(chron)
library(plumber)
library(DBI)
library(anytime)


db="ad"
table="ts_Yahoo_A1Benchmark_real_1"
col=2

# fetch data from the dbtable
con <- dbConnect(RMySQL::MySQL(), dbname = db, username= "root", password = "sither04", host = "127.0.0.1", port = 3306)
res0 <- dbSendQuery(con, sprintf("select * from %s", table))
d = fetch(res0, n=-1)
dbDisconnect(con)
PERIOD  = 2
# col = as.numeric(col)

# INSERT date in database=ad-services table=services
dockerid = 0 # TODO:
pid = Sys.getpid()
status = 'started'
start_time <- as.POSIXlt(Sys.time(), format = "%d-%m-%Y %H:%M:%S")
query = sprintf("INSERT INTO services (dockerid, pid, start_time, status, end_time) VALUES(%d, %d, '%s', '%s', '%s')", dockerid,pid,start_time,status,start_time)
con <- dbConnect(RMySQL::MySQL(), dbname = "ad-services", username= "root", password = "sither04", host = "127.0.0.1", port = 3306)
res1 <- dbSendQuery(con, query)
dbClearResult(res1)
dbDisconnect(con)
## 

res = AnomalyDetectionVec(d[, col], max_anoms=0.02, period=PERIOD, direction='both', only_last=FALSE, plot=TRUE)
status = 'noanomaly'
result_db = 'ad-results'
result_table= ''

# save the result to database
if (!is.null(res$plot)){
  message ("plot is NOT null");
  status = 'completed'
  
  # 3rd column gives the predicted anomaly (1/0)
  if (TRUE){
    d[ncol(d)+1] = 0
    for (index in c(res$anoms$index)){
      d[index, ncol(d)] = 1
    }
    # TODO: add the anomaly score in the result_db and result_table
    Sys.sleep(5)
    
    time = as.numeric(Sys.time())
    #result_db = anydate(time)
    #result_table = toString(time)
    result = "resultdb"
    result_table = "result_table"
    #con <- dbConnect(RMySQL::MySQL(), dbname = db, username= "root", password = "sither04", host = "127.0.0.1", port = 3306)
    #res0 <- dbSendQuery(con, sprintf("SHOW COLUMNS from %s", table))
    #cols = fetch(res0, n=-1)
    #head(cols)
    #query = sprintf("CREATE TABLE %s as ", result_table);
    #con <- dbConnect(RMySQL::MySQL(), dbname = result_db, username= "root", password = "sither04", host = "127.0.0.1", port = 3306)
    #rr1 <- dbSendQuery(con, query)
    
  }
}


# update the services table
end_time <- as.POSIXlt(Sys.time(), format = "%d-%m-%Y %H:%M:%S")
query = sprintf("UPDATE services SET status='%s', end_time='%s', result_db='%s', result_table='%s' WHERE start_time = '%s' AND pid=%d", status,end_time,result_db,result_table,start_time,pid)
con <- dbConnect(RMySQL::MySQL(), dbname = "ad-services", username= "root", password = "sither04", host = "127.0.0.1", port = 3306)
res2 <- dbSendQuery(con, query)
dbClearResult(res2)
dbDisconnect(con)


# kill all connections
#all_cons <- dbListConnections(RMySQL::MySQL())
#print(all_cons)
#for(con in all_cons)
#  +  dbDisconnect(con)
#print(paste(length(all_cons), " connections killed."))


# return status
list(indices = paste0(res$anoms$index))