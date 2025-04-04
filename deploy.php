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
    'web/app/cache/acorn/framework/cache',
]);
set('writable_dirs', [
    'web/app/cache/acorn/framework/cache',
]);
set('local_root', __DIR__);
set('theme_path', 'web/app/themes/test');
set('vagrant_dir', __DIR__);
set('vagrant_root', '/var/www/html/test/current');
set('sync_dirs', [
    __DIR__ . '/web/app/uploads/' => '{{deploy_path}}/shared/web/app/uploads/',
]);

host('188.245.201.118')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '/var/www/html/test')
    ->set('branch', 'main')
    ->set('stage', 'production');

desc('Deploy the application');

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

    // Очистка
    writeln("<info>Removing local SQL dump...</info>");
    runLocally("rm {$localDump}");

    writeln("<info>Removing remote SQL dump...</info>");
    run("rm {$remoteDump}");



    writeln("<info>✅ Database successfully pushed to remote.</info>");
});

task('npm:build', function () {
    $themePath = '{{release_path}}/' . get('theme_path');
    run("cd {$themePath} && npm install && npm run build");
});

task('deploy', [
    'deploy:prepare',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'bedrock:vendors',
    'sage:vendors',
    'sage:compile',
    'bedrock:env',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'deploy:cleanup',
    'deploy:success',
]);

after('deploy:failed', 'deploy:unlock');
