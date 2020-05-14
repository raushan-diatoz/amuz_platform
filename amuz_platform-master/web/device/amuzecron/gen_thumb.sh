#!/bin/bash
shopt -s globstar
doc=0
for file in /amuz_media/hindi/Comedy/*.mp4
do
       echo "generating thumb nail for $file"
	avconv -i "$file" -vsync 1 -r 1  -an -y "${file%.mp4}.jpg"
        doc=$((doc+1))
done
echo "generated $doc thumbnails"

