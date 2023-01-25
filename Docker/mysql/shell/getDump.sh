source config/server.cfg
mysqldump --defaults-extra-file=./config/dev.cfg --opt --protocol=TCP --host=${DBSERVER} ${DATABASE} > ${FILE} --no-tablespaces
