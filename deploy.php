<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Hotel App');

// Project repository
set('repository', 'git@bitbucket.org:yorexbytes/hotel-app.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_dirs', [
	'storage/app',
	'storage/framework/cache',
	'storage/framework/sessions',
	'storage/framework/views',
	'storage/logs',
]);
set('shared_files', ['.env']);

// Writable dirs by web server 
set('writable_dirs', ['storage', 'vendor']);

set('writable_mode', 'chmod');
set('writable_chmod_mode', '0775');

// Hosts

host('167.99.96.137')->user('deployer')
	->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '/var/www/html/hotel-app');
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

desc('Execute artisan artisan passport:keys');

task('passport:keys', function () {
	run('{{bin/php}} {{release_path}}/artisan passport:keys --force');
	run('{{bin/php}} {{release_path}}/artisan db:seed --class=PageItemSeeder');
	run('{{bin/php}} {{release_path}}/artisan db:seed --class=HotelServiceSeeder');
	run('{{bin/php}} {{release_path}}/artisan config:clear');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
after('deploy:symlink', 'passport:keys');

