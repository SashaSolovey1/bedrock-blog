<?php

namespace Deployer;

require 'vendor/deployer/deployer/recipe/common.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_env.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_misc.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/filetransfer.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/sage.php';

set('repository', 'https://github.com/SashaSolovey1/bedrock-blog.git');
set('shared_dirs', [
    'web/app/uploads',
    'web/app/cache',
    ]);
set('shared_files', ['.env']);
set('writable_dirs', [
    'web/app/cache',
    'web/app/cache/acorn',
    'web/app/cache/acorn/framework/views',
]);
set('local_root', __DIR__);
set('theme_path', 'web/app/themes/test');
set('sync_dirs', [
    __DIR__ . '/web/app/uploads/' => '{{deploy_path}}/shared/web/app/uploads/',
]);

host('188.245.201.118')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '/var/www/html/test')
    ->set('branch', 'main')
    ->set('stage', 'production');

desc('Deploy the application');
task('deploy:writable', function () {
    $dirs = get('writable_dirs');
    foreach ($dirs as $dir) {
        run("sudo chown -R www-data:www-data {{release_path}}/$dir");
        run("sudo chmod -R 775 {{release_path}}/$dir");
    }
});
task('push:db', function () {
    $timestamp = date('Ymd_His');
    $localDump = "_db_export_{$timestamp}.sql";
    $remoteDump = "{{deploy_path}}/shared/{$localDump}";

    $localPath = __DIR__;
    $remotePath = '{{current_path}}';

    writeln("<info>Exporting local DB...</info>");
    runLocally("cd {$localPath} && wp db export {$localDump}");

    writeln("<info>Uploading SQL dump to remote server...</info>");
    upload($localDump, $remoteDump);

    writeln("<info>Importing SQL dump on remote server...</info>");
    run("cd {$remotePath} && wp db import {$remoteDump}");

    writeln("<info>Removing local SQL dump...</info>");
    runLocally("rm {$localDump}");

    writeln("<info>Removing remote SQL dump...</info>");
    run("rm {$remoteDump}");

    writeln("<info>✅ Database successfully pushed to remote.</info>");
});


task('deploy', [
    'deploy:prepare',
    'deploy:update_code',
    'deploy:shared',
    'bedrock:vendors',
    'sage:vendors',
    'push:assets',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'deploy:cleanup',
    'deploy:success',
]);

after('deploy:failed', 'deploy:unlock');
