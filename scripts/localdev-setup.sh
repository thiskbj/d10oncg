#!/bin/bash
set -euo pipefail

echo "Populating database"
vendor/bin/drush sql-drop -y
vendor/bin/drush sql-cli < $(vendor/bin/drush dd)/../db/dbtestdump.001.sql
echo "Updating UUID"
UUID=$(grep uuid config/system.site.yml | cut -d' ' -f2)
#vendor/bin/drush config:set "system.site" uuid "$UUID" –yes
vendor/bin/drush config:set "system.site" uuid "$UUID" -y
echo "Cleaning up Shortcuts, extraneous fields"
vendor/bin/drush entity:delete shortcut -y || echo "Error deleting shortcut entity"
vendor/bin/drush entity:delete shortcut_set -y || echo "Error deleting shortcut_set entity"
vendor/bin/drush config-delete -y field.field.node.article.body || echo "Error deleting field.field.node.article.body"
echo "Importing config"
vendor/bin/drush config:import --source='../config' -y
vendor/bin/drush import-all --choice=safe
echo "Rebuilding cache"
vendor/bin/drush cache:rebuild --yes
