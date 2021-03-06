#This will install MySQL, Apache, and PHP when creating the vagrant virtual box

apt-get update
apt-get install -y apache2

if ![-L /var/www]; then
	rm -rf /var/www
	ln -fs /vagrant /var/www
fi

#will set password of mysql to "mysqlpassword"
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password mysqlpassword'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password mysqlpassword'
sudo apt-get -y install mysql-server

#Load the sql database and tables into mysql
mysql -u root -pmysqlpassword < /var/www/ripple/database/createDB.sql
mysql -u root -pmysqlpassword Ripple < /var/www/ripple/database/data.sql

# to install PHP
sudo apt-get install php5 -y libapache2-mod-php5 php5-mcrypt
sudo apt-get -y install php5-mysql

#Restart Apache Server
sudo /etc/init.d/apache2 restart
