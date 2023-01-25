source config/server.cfg
mysql --defaults-extra-file=./config/local.cfg  -e 'DROP DATABASE backup;'
mysql --defaults-extra-file=./config/local.cfg  -e 'CREATE DATABASE backup;'
mysqldump --defaults-extra-file=./config/dev.cfg --opt --protocol=TCP --host=${DBSERVER} ${DATABASE} > ${FILE} --no-tablespaces
mysql --defaults-extra-file=./config/local.cfg backup < dump.sql
