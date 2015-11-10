set :application, "Scrum agile collaboration platform"
set :domain,      "scrum-agile.cn"
set :deploy_to,   "/var/www/scrum-agile"
set :app_path,    "app"

set :repository,  "https://github.com/kendoctor/scrum-agile.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :deploy_via,  :capifony_copy_local

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server


set :use_sudo, false
set :user, "kendoctor"

set  :keep_releases,  3

#set :dump_assetic_assets, true
set :use_composer, true
#set :update_vendors, true
set :use_composer_tmp, true
#set :copy_vendors, true

set :shared_files, ["app/config/parameters.yml"]
set :shared_children, [app_path + "/logs", web_path + "/uploads" ]

set :writable_dirs, ["app/cache", "app/logs"]
set :webserver_user, "www-data"

set :permission_method, :acl
set :use_set_permissions, true

#ssh_options[:forward_agent] = true
default_run_options[:pty] = true


#before 'symfony:assetic:dump', 'bower:install'


# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL