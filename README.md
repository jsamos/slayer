#sample config

```
<?php
return [

    'services' => [

        'upload-manager' => [
            'class' => 'Namespace\UploadManager',
            'config' => [
                'client' => 'upload'
            ],
        ],

        'data-manager' => [
            'class' => 'Namespace\DataManager',
            'config' => [
                'services' => ['upload-manager'],
            ],
        ],

    ],

];
```