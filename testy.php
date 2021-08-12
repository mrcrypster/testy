<?php

# SRC: https://raw.githubusercontent.com/mrcrypster/testy/main/testy.php

class testy {
  
  # Abstract function to be implemented in child classes
  protected static function prepare() {}
  
  # Print type and value of a variable
  protected static function val($var) {
    ob_start();
    var_dump($var);
    return trim(ob_get_clean());
  }
  
  # Compare expected and fact value, output results
  public static function assert($expected, $fact, $explanation) {
    # printf "Default color \033[0;32m green color \033[0m default again \n"
    if ( $expected === $fact ) {
      $print_details = false;
      echo "\033[0;32m" . 'OK :' . "\033[0m" . ' ';
    }
    else {
      $print_details = true;
      echo "\033[0;31m" . 'ERR:' . "\033[0m" . ' ';
    }
    
    echo $explanation . "\n";
    if ( $print_details ) {
      echo '     Expected: ' . "\033[0;36m" . self::val($expected) . "\033[0m" . "\n";
      echo '     Got:      ' . "\033[0;31m"  . self::val($fact) . "\033[0m" . "\n";
    }
  } 
  
  # Run all tests
  public static function run() {
    # do preparations
    static::prepare();

    echo "\n";
    # Execute test cases    
    $methods = (new ReflectionClass('tests'))->getMethods(ReflectionMethod::IS_STATIC);
    foreach ( $methods as $method ) {
      if ( strpos($method->name, 'test_') !== 0 ) continue;
      echo "\033[1;33m" . '---- ' . str_replace('test_', '', $method->name) . '() ----' . "\033[0m" . "\n\n";
      call_user_func(array('tests', $method->name));
      echo "\n\n";
    }
    echo "\n";
  }
}