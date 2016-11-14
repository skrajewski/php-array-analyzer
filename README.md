ArrayAnalyzer
==========

Simple PHP array analyzer which contains some helpful static methods.

## Methods

| Method                                        | Description                                                                                         | Return value |                                                    |
|-----------------------------------------------|-----------------------------------------------------------------------------------------------------|--------------|----------------------------------------------------|
| checkOrderChange(array $before, array $after) | Recognize a single position change of one element in array by analyzing *before* and *after* arrays | array        | `['from' => int, 'to' => int, 'element' => mixed]` |
| isSequential(array $array)                    | Check if array is sequential                                                                        | bool         |                                                    |
| isAssoc(array $array)                         | Check if array is associative                                                                       | bool         |                                                    |
| getMaxDepth(array $array)                     | Get max depth of array                                                                              | int          | Return 1 when array is single dimensional          |

## Purpose

I needed this kind of functions in my project, so I decided to set all of them in a single place. If it's helpful for you, please let me know by mentioning me in social media, for instance in [twitter](https://twitter.com/szykry). Thanks! 

## License

The MIT License.
