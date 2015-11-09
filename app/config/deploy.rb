set :application, "set your application name here"
set :domain,      "114.215.197.19"
set :deploy_to,   "/var/www/scrum-agile"
set :app_path,    "app"
set :user,        "root"

set :repository,  "https://github.com/kendoctor/scrum-agile.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL