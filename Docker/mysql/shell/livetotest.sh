mysql --defaults-extra-file=./config/local.cfg -e 'DROP DATABASE test;'
mysql --defaults-extra-file=./config/local.cfg -e 'CREATE DATABASE test;'
mysqldump --defaults-extra-file=./config/local.cfg live | mysql --defaults-extra-file=./config/local.cfg test