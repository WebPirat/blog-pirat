#!/bin/bash

search_dir=./backup
addVar=()
db=("backup" "live")
for entry in "$search_dir"/*
do
  arrVar+=("$entry")
done
arrVar+=("Exit")
echo $arrVar;
PS3='Wähle einen Server '
arrsize=${#db[@]}
select option in "${db[@]}"; do
  if [ "$REPLY" -eq "$arrsize" ];
  then
    echo "Exiting..."
    break;
  elif [ 1 -le "$REPLY" ] && [ "$REPLY" -le $((arrsize-1)) ];
  then
    break;
  else
    echo "Incorrect Input: Select a number 1-$arrsize"
  fi
done

PS3='Wähle ein Backupfile '
arrsize=${#arrVar[@]}
select file in "${arrVar[@]}"; do
  if [ "$REPLY" -eq "$arrsize" ];
  then
    echo "Exiting..."
    break;
  elif [ 1 -le "$REPLY" ] && [ "$REPLY" -le $((arrsize-1)) ];
  then
    break;
  else
    echo "Incorrect Input: Select a number 1-$arrsize"
  fi
done

PS3="DB $option mit $file wiederherstellen ?"
yesno=("Ja" "Nein")
arrsize=${#yesno[@]}
select complete in "${yesno[@]}"; do
  if [ "$REPLY" -eq "$arrsize" ];
  then
    echo "Exiting..."
    break;
  elif [ 1 -le "$REPLY" ] && [ "$REPLY" -le $((arrsize-1)) ];
  then
    source config/server.cfg
    mysql --defaults-extra-file=./config/local.cfg --protocol=TCP --host=${LOCALSERVER} ${option} < ${file}
    echo "backup von $option mit $file durchgeführt"
    break;
  else
    echo "Incorrect Input: Select a number 1-$arrsize"
  fi
done

