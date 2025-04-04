<?php
namespace Deployer;

require 'recipe/common.php';

set('application', 'bedrock-blog');
set('repository', 'https://github.com/SashaSolovey1/bedrock-blog.git');
set('webroot', 'web');
set('shared_files', ['.env']);
set('shared_dirs', ['web/app/uploads']);
set('writable_dirs', ['web/app/uploads']);
set('allow_anonymous_stats', false);

host('188.245.201.118')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '/var/www/html/test');

after('deploy:failed', 'deploy:unlock');

desc('Deploy the application');
task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'deploy:shared',
    'deploy:writable',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:cleanup',
]);

after('deploy', 'success');
