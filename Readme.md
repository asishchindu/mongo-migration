Module Dependencies:

```
https://www.drupal.org/project/mongodb
https://www.drupal.org/project/migrate_plus
```



Add the below code in settings.php

```
$settings['mongodb'] = [
  'clients' => [
    'default' => [
      'uri' => 'mongodb+srv://url',
      'uriOptions' => [],
      'driverOptions' => [],
    ],
  ],
];
```
