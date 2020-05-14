#!/bin/bash
HOSTS="139.16.18.196"
COUNT=4
for myHost in $HOSTS
do
	count=$(ping -c $COUNT $myHost | grep 'received' | awk -F',' '{ print $2 }' | awk '{ print $1 }')
    if [ $COUNT -eq 4 ]; then
	current_time=$(date "+%Y-%m-%d-%H-%M-%S")
	PROPRTYFILE=/usr/share/nginx/adminhtml/admin/ini.properties
	logfilename="iostat@$DSK@$current_time"
	sshpass -p "8m74AU3k" scp /usr/share/nginx/html/logs/iostatlogs/iostat.out root@139.162.18.196:/usr/share/nginx/adminhtml/admin/logs/iostatlogs/"$logfilename".out
	rm -f usr/share/nginx/html/logs/iostatlogs/iostat.out
	iostat -c -d -x -t -m 1 900 > /usr/share/nginx/html/logs/iostatlogs/iostat.out
	exit
    fi
done