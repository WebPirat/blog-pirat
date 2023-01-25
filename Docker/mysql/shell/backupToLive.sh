mysql --defaults-extra-file=./config/local.cfg  -e 'DROP DATABASE live;'
mysql --defaults-extra-file=./config/local.cfg -e 'CREATE DATABASE live;'
mysqldump --defaults-extra-file=./config/local.cfg backup | mysql --defaults-extra-file=./config/local.cfg live