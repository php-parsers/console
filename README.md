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

## Additional information

The code is licensed under the MIT license.

