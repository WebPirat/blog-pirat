source config/server.cfg
today=$(date +"%d-%m-%Y-%H:%M")
file=backup-${today}.sql
mysqldump --defaults-extra-file=./config/local.cfg --opt --protocol=TCP --host=${LOCALSERVER} ${LOCALDB} > ${file} --no-tablespaces
mv ${file} ./backup/${file}