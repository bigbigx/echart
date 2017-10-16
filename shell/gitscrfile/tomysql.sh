#!/bin/bash
host=localhost
user=root
#database=gitlog
#table=gitlog

mysql --local-infile -u$user -h$host --database gitlog << EOF
truncate table gitlog;
load data local infile '/opt/gitscrfile/data/alldata.txt' into table gitlog;
EOF

