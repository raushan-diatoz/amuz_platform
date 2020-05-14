#!/bin/bash
FILES=/usr/share/nginx/html/logs/piwik_data/*
PROPRTYFILE=/usr/share/nginx/adminhtml/admin/ini.properties
DSK=$(grep -i 'deviceserialkey' $PROPRTYFILE | cut -f2 -d '=')
for f in $FILES
do
  echo $DSK	
  echo "Processing $f file..."
  newfilename=$DSK@$(date "+%Y-%m-%d-%H-%M-%S")
  sshpass -p "8m74AU3k" scp $f root@139.162.18.196:/usr/share/nginx/adminhtml/admin/logs/piwik_data/"$newfilename".js
  RET_VAL_STATUS=$?
  echo $RET_VAL_STATUS
  if [ $RET_VAL_STATUS -ne 0 ]
  then	
	echo "not uploaded"
  else
	echo "uploaded successfully"
	rm -f $f
  fi	
done
