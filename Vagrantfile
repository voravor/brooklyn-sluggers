# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!

required_plugins = %w(vagrant-share vagrant-vbguest vagrant-triggers vagrant-berkshelf vagrant-omnibus)

plugins_to_install = required_plugins.select { |plugin| not Vagrant.has_plugin? plugin }
if not plugins_to_install.empty?
  puts "Installing plugins: #{plugins_to_install.join(' ')}"
  if system "vagrant plugin install #{plugins_to_install.join(' ')}"
    exec "vagrant #{ARGV.join(' ')}"
  else
    abort "Installation of one or more plugins has failed. Aborting."
  end
end
VAGRANTFILE_API_VERSION = '2'

Vagrant.require_version '>= 1.5.0'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  

  	config.vm.hostname = 'scotchbox'
  	config.vm.network "private_network", ip: "192.168.33.10"
	config.vm.box = 'scotch/box'
	config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777", "fmode=666"]

  	config.vm.provider :virtualbox do |vb|
     vb.customize ["modifyvm", :id, "--memory", "1024"]
     vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
   end


end
