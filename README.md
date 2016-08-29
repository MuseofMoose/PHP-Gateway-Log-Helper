# PHP-Param-Log-Helper

### Description:
This PHP snippet is a simple helper I built to clean up my gateway functions which were in charge of
logging params that were being passed from the client to the API. It performs a backtrace to fetch the current class and function names and then uses them to create a reflection object. From there we can fetch the param names and pair them with their respective passed in values.

### Note:
The current implementation has a dependency on apache log4php and the Logger object is initialized in the constructor of the class (and not included in this snippet). Feel free to use your own logging service and simply replace all instances of "$this->log->....." with the logging syntax for your own selection.

   * Combines all parameter names and values into a log message. <p>
     * Parameters named in the $excludedParamsArray(as strings) will be <b>excluded</b>. <p>
     * Log types are 'debug', 'info', or 'error'.
     * @param string $logType
     * @param array $excludedParamsArray (optional)

### Params:
string $logType - The type of log you want to be outputted. For log4php the main options are 'debug', 'info', or 'error'.
array $excludedParamsArray (optional) - An array of strings, where each string is the name of a param you DON'T want to be included in the log. Useful when you're passing sensitive params like passwords.

### Basic Usage (to be updated):
Simply call this function from whatever other function you would like a param log for. Pass the type of the log and, optionally, the names of any params you want omitted from the log.


### Todo:
Enhance this readMe.
Add code to create the Logger instance (instead of relying on the object initialized in the constructor (and not visible in the snipper)).
Take a second look as far as optimization is concerned.
