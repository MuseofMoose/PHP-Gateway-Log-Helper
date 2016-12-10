# PHP-Param-Log-Helper
This PHP snippet is a simple helper to log params that are being passed through the gateway functions of an API. It performs a backtrace to fetch the current class and function name and then uses them to create a reflection object. From there we can fetch the param names and pair them with their respective passed in values.

### Note:
The current implementation has a dependency on apache log4php and the Logger object is initialized in the constructor of the class (and not included in this snippet). Feel free to use your own logging service and simply replace all instances of "$this->log->....." with the logging syntax of your own selection.

### Params:
  * string **$logType** - The type of log you want to be outputted. For log4php the main options are 'debug', 'info', or 'error'.
  * array **$excludedParamsArray** (optional) - An array of strings, where each string is the name of a param you DON'T want to be included in the log. Useful when you're passing sensitive params like passwords.

### Basic Usage:
Simply call this function from whatever other function you would like a param log for. Pass the type of log and, optionally, the names of any params you want omitted from the log.

### Example:
Say you have the following function with the param helper in the same class (or an extended class):
```PHP
public function UpdateUserPassword(userId, oldPassword, newPassword){
  $this->CreateParameterLog('debug', array('oldPassword', 'newPassword'));
  //Rest of the code........
}
```
And you call said function like so:
```
UpdateUserPassword(5, 'preciouspotato', 'magicalostrich');
```
This would create a debug log that looks like this:
```
ClassName::UpdateUserPassword call with params : userId = 5
```
Notice how the two params in the exclusion array are not in the log.

You might next ask, "What if there are no params at all?"
Then you would end up with a log that looks like this:
```
ClassName::SomeFunction call without params
```
### Todo:
Enhance this readMe.
Take a second look as far as optimization is concerned.
