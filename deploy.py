#!/usr/bin/env python3
from deployment import deployment
import os

class AppDeployScript(deployment.DeployScript):
    def build(self, cmd):
        cmd.link_storage_file('.env.local', '.env')
        cmd.link_storage_dir('public/storage')
        cmd.link_storage_dir('public/uploads')
        cmd.link_storage_dir('var/log')
        cmd.link_storage_dir('var/sessions')
        cmd.link_storage_dir('config/jwt')

        cmd.composer('install', '--no-suggest',  '--optimize-autoloader')
        cmd.php('bin/console', 'cache:warmup')

    def deploy(self, cmd):
        cmd.php('bin/console', 'doctrine:migrations:migrate', '--no-interaction', '--allow-no-migration')
        self.switch_to_code_version(cmd, cmd.version_dir)


if __name__ == '__main__':
    deployment.run_deploy(__file__, AppDeployScript)

