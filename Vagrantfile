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

    








# Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
  # documentation for more information about their specific syntax and use.
  # config.vm.provision "shell", inline: <<-SHELL
  #   apt-get update
  #   apt-get install -y apache2
  # SHELL
end
