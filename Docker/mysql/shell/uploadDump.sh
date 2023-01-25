FILE=save.sql.`date +"%Y%m%d"`

unalias rm     2> /dev/null
rm ${FILE}     2> /dev/null
rm ${FILE}.gz  2> /dev/null

mysqldump --opt --protocol=TCP --user=${USER} --password=${PASS} --host=${DBSERVER} ${DATABASE} > ${FILE} --no-tablespaces

echo "${FILE} was created:"
ls -l ${FILE}