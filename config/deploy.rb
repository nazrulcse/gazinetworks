# config valid for current version and patch releases of Capistrano
lock "~> 3.10.0"

# Set some options
 set :application, "gazinetwork.one" # Set the name of your application
 #set :scm, "git" # Set the version control type (I use GIT, SVN + others are also available)
 set :repository, "git@github.com:nazrulcse/gazinetworks.git" # Set the path to your version control repository
 set :branch, "admin" # Set the branch of the version control repository to deploy from
 set :deploy_to, "/" # The remote path to deploy to (not the web root - you will need to edit this in your web server config later)
 set :login, "gazinetwork.one" # Remote user to connect via SSH as
 set :password, "gazinetwork" # Remote user to run commands as
 set :ftp_host, 'ftp.gazinetwork.one' # The port number to use for SSH
 set :copy_exclude, %w[.DS_Store .git .gitignore Capfile deploy.rb sftp-config.json] # List of files that shouldn't be deployed
 set :keep_releases, 10 # Number of releases to keep on the server (allows you to roll back your application to a previous version)
 
# Deployment servers
 role :server1, "gazinetwork.one" # The domain or IP address of your web server

# After we've deployed, cleanup the old releases
 # after "deploy:update", "deploy:cleanup"