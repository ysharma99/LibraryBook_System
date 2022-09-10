# -*- mode: ruby -*-
# vi: set ft=ruby :

# A Vagrantfile used to run 3 VMS - one database server and two webservers (customer website, admin website)
Vagrant.configure("2") do |config|
  
# All servers will run Ubuntu
config.vm.box = "ubuntu/focal64"

#Automatically check for box updates on vagrant up 
config.vm.box_check_update = true

# Sets up a VM for hosting a admin web interface 
config.vm.define "awebserver" do |awebserver|
  
#Sets the name of the server
awebserver.vm.hostname = 'awebserver'


#Sets up port forwarding so that the host computer can connect to IP address 127.0.0.1 port 8080,
# and that network request will reach our webserver VM's port 80.
awebserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

# Sets up a private network that our VMs will use to communicate and assigns an ip
# for the VM on the private network
awebserver.vm.network "private_network", ip: "192.168.2.11"

# This was taken from the lab work - This following line is only necessary in the CS Labs... but that                                                                
    # may well be where markers mark your assignment.                                                                                 
    awebserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    # Now we have a section specifying the shell commands to provision                                                                
    # the awebserver VM. Note that the file test-website.conf is copied                                                                
    # from this host to the VM through the shared folder mounted in                                                                   
    # the VM at /vagrant                                                                                                              
    awebserver.vm.provision "shell", path: "build-awebserver-vm.sh"
  end

  #Sets up a VM for hosting a customer web interface 
  config.vm.define "cwebserver" do |cwebserver|


  #Sets the name of the server 
  cwebserver.vm.hostname = "cwebserver"

  #Sets up port forwarding so that the host computer can connect to IP address 127.0.0.1 port 8082
  # and that network request will reach our webserver VM's port 80.
  cwebserver.vm.network "forwarded_port", guest: 80, host: 8082, host_ip: "127.0.0.1"

  # Sets up a private network that our VMs will use to communicate and assigns an ip
  # for the VM on the private network
cwebserver.vm.network "private_network", ip: "192.168.2.12"

# This was taken from the lab work - This following line is only necessary in the CS Labs... but that                                                                
    # may well be where markers mark your assignment.                                                                                 
    cwebserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    # Now we have a section specifying the shell commands to provision                                                                
    # the awebserver VM. Note that the file test-website.conf is copied                                                                
    # from this host to the VM through the shared folder mounted in                                                                   
    # the VM at /vagrant                                                                                                              
    cwebserver.vm.provision "shell", path: "build-cwebserver-vm.sh"
  end

  #Sets up a VM for hosting a database server
  config.vm.define "dbserver" do |dbserver|
  
  #Sets the name of the server 
  dbserver.vm.hostname = "dbserver"

  # Assign the ip for the VM on the private network
  dbserver.vm.network "private_network", ip: "192.168.2.13"

  # This was taken from the lab work - This following line is only necessary in the CS Labs... but that                                                                
    # may well be where markers mark your assignment.                                                                                 
    dbserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    # Now we have a section specifying the shell commands to provision                                                                
    # the awebserver VM. Note that the file test-website.conf is copied                                                                
    # from this host to the VM through the shared folder mounted in                                                                   
    # the VM at /vagrant                                                                                                              
    dbserver.vm.provision "shell", path: "build-dbserver-vm.sh"
end