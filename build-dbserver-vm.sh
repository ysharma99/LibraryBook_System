#!/bin/bash
# Almost all of these comments are taken from lab work.

# Update Ubuntu software packages.
apt-get update
      
# We create a shell variable MYSQL_PWD that contains the MySQL root password
export MYSQL_PWD='P@ssw0rD'

# If you run the `apt-get install mysql-server` command
# manually, it will prompt you to enter a MySQL root
# password. The next two lines set up answers to the questions
# the package installer would otherwise ask ahead of it asking,
# so our automated provisioning script does not get stopped by
# the software package management system attempting to ask the
# user for configuration information.
echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

# Install the MySQL database server.
apt-get -y install mysql-server
# On normal VMs MySQL server will now be running, but starting
# the service explicitly even if it's started causes no warnings.
# Therefore, will start it explicitly now to make sure its started.
service mysql start

# Run some setup commands to get the database ready to use.
# First create a database.
echo "CREATE DATABASE bookstorage;" | mysql

# Then create a database user "admin" with the given password.
echo "CREATE USER 'admin'@'%' IDENTIFIED BY 'P@ssw0rD';" | mysql
echo "CREATE USER 'customer'@'%' IDENTIFIED BY 'Pa55w0rD';" | mysql

# Grant all permissions to the database user "admin" regarding
# the "bookstorage" database that we just created, above.
echo "GRANT ALL PRIVILEGES ON bookstorage.* TO 'admin'@'%'" | mysql
echo "GRANT SELECT ON bookstorage.* TO 'customer'@'%'" | mysql

# Set the MYSQL_PWD shell variable that the mysql command will
# try to use as the database password ...
export MYSQL_PWD='P@ssw0rD'

# ... and run all of the SQL within the setup-database.sql file,
# which is part of the repository containing this Vagrantfile, so you
# can look at the file on your host. The mysql command specifies both
# the user to connect as (admin) and the database to use (bookstorage).
cat /vagrant/setup-database.sql | mysql -u admin bookstorage
cat /vagrant/setup-database.sql | mysql -u customer bookstorage

# By default, MySQL only listens for local network requests,
# i.e., that originate from within the dbserver VM. We need to
# change this so that the webserver VM can connect to the
# database on the dbserver VM. Use of `sed` is pretty obscure,
# but the net effect of the command is to find the line
# containing "bind-address" within the given `mysqld.cnf`
# configuration file and then to change "127.0.0.1" (meaning
# local only) to "0.0.0.0" (meaning accept connections from any
# network interface).
sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

# We then restart the MySQL server to ensure that it picks up
# our configuration changes.
service mysql restart
