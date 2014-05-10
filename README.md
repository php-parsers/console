# Console

Rapidly parse complex console commands into well-structured arrays.

## Features

+ supports both arguments and options
+ all values can be either escaped (`'foo bar'` or `"w*w"`) or unescaped (`bare`)
+ supports both short (`-f`) and long (`--foo-bar`) options 
+ either the equal sign or a white space can be used (`-f=value` or `--bar value`) 
+ options can have no value (be used as a flag), e.g. `-f --no-backup`
+ cumulative options (`-kkk`, `-vv`)
+ collapsed short options (`-a -b -c` is equal to `-abc`)

## Output

`your-command argument "another argument" -vvv -abc10 -f -n10 -g 5 --flag --val='g'`

```php
[
    'name' => 'your-command',
    'arguments' => ['argument', 'another argument'],
    'options' => [
        'v' => [
            'value' => null,
            'volume' => 3
        ],
        'a' => [
            'value' => null,
            'volume' => 1
        ],
        'b' => [
            'value' => null,
            'volume' => 1
        ],
        'c' => [
            'value' => '10',
            'volume' => 1
        ],
        'f' => [
            'value' => null,
            'volume' => 1
        ],
        'n' => [
            'value' => '10',
            'volume' => 1
        ],
        'g' => [
            'value' => '5',
            'volume' => 1
        ],
        'flag' => [
            'value' => null,
            'volume' => 1
        ],
        'val' => [
            'value' => 'g',
            'volume' => 1
        ]
    ]
]
```

## Additional information

The code is licensed under the MIT license.

