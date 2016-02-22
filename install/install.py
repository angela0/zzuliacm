#!/usr/bin/env python
# coding=utf-8

import os

res = os.popen('cat /etc/redhat-release')

release = ""
WEBBASE = ""
APACHEUSER = ""
DBUSER = "root"
DBPASS = "root"

if "CentOS" in res:
    release = "CentOS"
else:
    release = "Ubuntu"

if release == "CentOS":
    WEBBASE = "/var/www/html"
    APACHEUSER = "apache"
    os.system('yum -y update')
    os.system('yum -y install php httpd php-mysql mysql-server php-xml php-gd gcc-c++  mysql-devel php-mbstring glibc-static flex')
    os.system('/etc/init.d/mysqld start')
else:
    WEBBASE = "/var/www/html"
    APACHEUSER = "www-data"
    os.system('apt-get update')
    os.system('apt-get install make flex g++ clang libmysql++-dev php5 apache2 mysql-server php5-mysql php5-gd php5-cli mono-gmcs subversion')
    os.system('/etc/init.d/mysql start')

#create user and homedir
os.system('/usr/sbin/useradd -m -u 1536 judge')

os.system('cd ../core/ && sh make.sh')

os.system('cd ../ && cp -R web ' + WEBBASE + '/oj')
os.system('chmod -R 771 ' + WEBBASE + '/oj')
os.system('chown -R ' + APACHEUSER + ' ' + WEBBASE + '/oj')
os.system('cd install/ && mysql -u ' + DBUSER + ' -p ' + DBPASS + ' < db.sql')




