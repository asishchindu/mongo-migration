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
