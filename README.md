# in-arrays
Checks if a value exists in an array of arrays.

```php
use Jstewmc\InArrays\In;

$arrays = [
    'foo' => ['foo', 'bar', 'baz'],
    'bar' => ['foo', 'bar', 'baz']
];

$service = new In($arrays);

$service('foo', 'foo');  // returns true
$service('bar', 'foo');  // returns true
$service('bar', 'qux');  // returns false (value "qux" does not exist)
$service('baz', 'foo');  // returns false (array "baz" does not exist)
```

## Case-sensitivity

This library, like PHP, uses _case-sensitive_ keys and values.

For example:

```php
use Jstewmc\InArrays\In;

// note the lower-case key and value
$service = new In(['foo' => ['foo']);

$service('foo', 'foo');  // returns true
$service('FOO', 'foo');  // returns false (keys are case-sensitive)
$service('bar', 'FOO');  // returns false (values are case-sensitive)
```

That's about it!

## Author

[Jack Clayton](clayjs0@gmail.com)

## License

[MIT](https://github.com/jstewmc/in-arrays/blob/master/LICENSE)

## Version

### 0.1.0, August 27, 2016

* Initial release
