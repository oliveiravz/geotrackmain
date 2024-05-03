<?php return array(
    'root' => array(
        'name' => 'joaovictor/mqtt',
        'pretty_version' => 'dev-master',
        'version' => 'dev-master',
        'reference' => '22df9a3a81721aacee48b1f8655e3003c1a021fd',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'bluerhinos/phpmqtt' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'reference' => 'fe4b6b2fe3d1b651fe1456e147ad4f044fa70603',
            'type' => 'library',
            'install_path' => __DIR__ . '/../bluerhinos/phpmqtt',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'dev_requirement' => false,
        ),
        'joaovictor/mqtt' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'reference' => '22df9a3a81721aacee48b1f8655e3003c1a021fd',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'php-amqplib/php-amqplib' => array(
            'pretty_version' => 'v2.8.0',
            'version' => '2.8.0.0',
            'reference' => '7df8553bd8b347cf6e919dd4a21e75f371547aa0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../php-amqplib/php-amqplib',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'videlalvaro/php-amqplib' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => 'v2.8.0',
            ),
        ),
    ),
);
