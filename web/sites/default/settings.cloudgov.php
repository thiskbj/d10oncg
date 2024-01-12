<?php

// $settings['file_scan_ignore_directories'] = [
//   'node_modules',
//   'bower_components',
// ];
// $settings['entity_update_batch_size'] = 50;
// $settings['entity_update_backup'] = TRUE;
// 
// $settings['migrate_node_migrate_type_classic'] = FALSE;
#$settings['config_sync_directory'] = dirname(DRUPAL_ROOT) . '/web/config';
$settings['config_sync_directory'] = dirname(DRUPAL_ROOT) . '/config';

// $applicaiton_fqdn_regex = "^.+\.(app\.cloud\.gov|weather\.gov)$";
// $settings['trusted_host_patterns'][] = $applicaiton_fqdn_regex;

$cf_service_data = json_decode(getenv('VCAP_SERVICES') ?? '{}', TRUE);
foreach ($cf_service_data as $service_list) {
  foreach ($service_list as $service) {
    if (stristr($service['name'], 'database')) {
      $databases['default']['default'] = [
        'database' => $service['credentials']['db_name'],
        'username' => $service['credentials']['username'],
        'password' => $service['credentials']['password'],
        'prefix' => '',
        'host' => $service['credentials']['host'],
        'port' => $service['credentials']['port'],
        'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
        'driver' => 'mysql',
        'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
      ];
    }
    elseif (stristr($service['name'], 'secrets')) {
      $settings['hash_salt'] = hash('sha256', $service['credentials']['HASH_SALT']);
    }
    elseif (stristr($service['name'], 'storage')) {
      //$config['s3fs.settings']['region'] = $service['credentials']['region'];
      //$settings['s3fs.bucket'] = $service['credentials']['bucket'];
      //$settings['s3fs.region'] = $service['credentials']['region'];
//       $config['s3fs.settings']['region'] = 'us-gov-west-1';
//       $settings['s3fs.cssjs_host'] = '';
//       $settings['s3fs.disable_cert_verify'] = FALSE;
//       $settings['s3fs.domain_root'] = 'public';
//       $settings['s3fs.domain'] = $server_http_host . $s3_proxy_path_cms;
//       $settings['s3fs.hostname'] = $service['credentials']['fips_endpoint'];
//       $settings['s3fs.private_folder'] = 'private';
//       $settings['s3fs.public_folder'] = 'public';
//       $settings['s3fs.root_folder'] = 'cms';
//       $settings['s3fs.upload_as_private'] = FALSE;
//       $settings['s3fs.use_cname'] = TRUE;
//       $settings['s3fs.use_cssjs_host'] = FALSE;
//       $settings['s3fs.use_customhost'] = FALSE;
//       $settings['s3fs.use_https'] = TRUE;
//       $settings['s3fs.use-path-style-endpoint'] = FALSE;
      $config['s3fs.settings']['bucket'] = $service['credentials']['bucket'];
      $config['s3fs.settings']['region'] = $service['credentials']['region'];
      $settings['s3fs.access_key'] = $service['credentials']['access_key_id'];
      $settings['s3fs.secret_key'] = $service['credentials']['secret_access_key'];
      $settings['s3fs.use_s3_for_private'] = TRUE;
      $settings['s3fs.use_s3_for_public'] = TRUE;
    }
  }
}
//     $config['system.site']['slogan'] = 'Loaded from settings.cloudgov.php general';
