/**
 * Combines all parameter names and values into a log message. <p>
 * Parameters named in the $excludedParamsArray(as strings) will be <b>excluded</b>. <p>
 * Log types are 'debug', 'info', or 'error'.
 * @param string $logType
 * @param array $excludedParamsArray (optional)
 */
public function CreateParameterLog($logType, $excludedParamsArray = null){
    if (!is_string($logType)){
        $this->log->error('$logType must be a String');
        return;
    }
    if (!is_null($excludedParamsArray) && !is_array($excludedParamsArray)){
        $this->log->error('$excludedParamsArray must be an Array');
        return;
    }
    $backtrace = debug_backtrace()[1];
    $className = $backtrace['class'];
    $methodName = $backtrace['function'];
    $args = $backtrace['args'];
    $reflectionMethod = new \ReflectionMethod($className, $methodName);
    $message = $reflectionMethod->class . '::' . $reflectionMethod->name;
    $reflectionParams = $reflectionMethod->getParameters();
    foreach ($reflectionParams as $index => $param){
        $reflectionParams[$index] = $param->name;
    }
    if (!is_null($excludedParamsArray)){
        $reflectionParams = array_diff($reflectionParams, $excludedParamsArray);
    }
    $message = $message . (count($reflectionParams) === 0 ? ' call without params' : ' call with params :');
    foreach ($reflectionParams as $index => $param){
        $message = $message . ' ' . $param . '=' . $args[$index];
    }
    if ($logType === 'error'){
        $this->log->error($message);
    }
    else if ($logType === 'info'){
        $this->log->info($message);
    }
    else {
        $this->log->debug($message);
    }
}
