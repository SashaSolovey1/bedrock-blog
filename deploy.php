<?php

namespace Deployer;

require 'vendor/deployer/deployer/recipe/common.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_db.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_env.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_misc.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/common.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/filetransfer.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/sage.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/trellis.php';

// === CONFIGURATION ===

// Git repository
set('repository', 'https://github.com/SashaSolovey1/bedrock-blog.git');

set('keep_releases', 2);

// Shared directories and files
set('shared_dirs', [
    'web/app/uploads',
    'web/app/cache',
]);
set('shared_files', ['.env']);

// Writable dirs
set('writable_dirs', [
    'web/app/cache',
    'web/app/cache/acorn',
    'web/app/cache/acorn/framework/views',
]);

set('writable_use_sudo', true);

set('writable_mode', 'chmod');

// Local root
set('local_root', __DIR__);

// Sage theme path
set('theme_path', 'web/app/themes/test');

// Directories to sync (e.g. uploads)
set('sync_dirs', [
    __DIR__ . '/web/app/uploads/' => '{{deploy_path}}/shared/web/app/uploads/',
]);

// Default stage
set('default_stage', 'production');

// === HOST ===

host('188.245.201.118')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '/var/www/html/test')
    ->set('branch', 'main')
    ->set('stage', 'production');

// === TASKS ===

desc('Deploy your project');
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

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// === CUSTOM TASK: Push local DB to remote ===

task('push:db', function () {
    $timestamp = date('Ymd_His');
    $localDump = "_db_export_{$timestamp}.sql";
    $remoteDump = "{{deploy_path}}/shared/{$localDump}";

    $localPath = __DIR__;
    $remotePath = '{{current_path}}';

    writeln("<info>📦 Exporting local DB...</info>");
    runLocally("cd {$localPath} && wp db export {$localDump}");

    writeln("<info>📤 Uploading SQL dump to remote server...</info>");
    upload($localDump, $remoteDump);

    writeln("<info>🛠 Importing SQL dump on remote server...</info>");
    run("cd {$remotePath} && wp db import {$remoteDump}");

    writeln("<info>🧹 Removing local SQL dump...</info>");
    runLocally("rm {$localDump}");

    writeln("<info>🧹 Removing remote SQL dump...</info>");
    run("rm {$remoteDump}");

    writeln("<info>✅ Database successfully pushed to remote.</info>");
});
