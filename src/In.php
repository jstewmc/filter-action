<?php
/**
 * The file for the in-arrays service
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */
 
namespace Jstewmc\InArrays;
 
use InvalidArgumentException;


/**
 * The in-arrays service
 *
 * @since  0.1.0
 */
class In
{
    /* !Private properties */
    
    /**
     * @var    mixed[]  an array of arrays, usually indexed by a string
     * @since  0.1.0
     */
    private $arrays;
    
    
    /* !Magic methods */
    
    /**
     * Called when the service is constructed
     *
     * @param   mixed[]  $actions  an array of arrays of indexed by string
     * @throws  InvalidArgumentException  if $arrays is not an array of arrays
     * @since   0.1.0
     */ 
    public function __construct(array $arrays)
    {
        if (count(array_filter($arrays, 'is_array')) !== count($arrays))  {    
            throw new InvalidArgumentException(
                __METHOD__ . "() expects parameter one, arrays, to be an array of "
                    . "arrays"
            );
        }
        
        $this->arrays = $arrays;
    }
    
    /**
     * Returns true if the value exists in the given array
     *
     * Keep in mind, if $needle is a string, the search will be case-insensitive.
     *
     * @param   mixed  $name    the array's index in arrays (case-insensitive)
     * @param   mixed  $needle  the value to search in the array
     * @param   bool   $strict  a flag indicating whether or not the value's type
     *     must match the needl's type (or object reference)
     * @return  int|false
     * @throws  InvalidArgumentException  if $name is an array or object
     * @see     http://php.net/manual/en/language.types.array.php  PHP's man page
     *     for an explanation of valid key types and the implicit type casting that
     *     occurs (accessed 8/27/16)
     * @since   0.1.0
     */
    public function __invoke($index, $needle, bool $strict = false): bool
    {
        // if $index is an illegal offset type, short-circuit
        if (is_array($index) || is_object($index)) {
            throw new InvalidArgumentException(
                __METHOD__ . "() expects parameter one, index, to be a valid offset "
                    . "type, not an object or array"
            );
        }
        
        return array_key_exists($index, $this->arrays)
            && in_array($needle, $this->arrays[$index], $strict);
    }
}
 