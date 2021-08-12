<?php

class testy {
  
  # Abstract function to be implemented in child classes
  protected static function prepare() {
    
  }
  
  # Compare expected and fact value, output results
  public static function assert($expected, $fact, $explanation) {
    # printf "Default color \033[0;32m green color \033[0m default again \n"
    if ( $actual === $should_be ) {
      $print_details = false;
      echo "\033[0;32m" . 'OK:' . "\033[0m" . ' ';
    }
    else {
      $print_details = true;
      echo "\033[0;31m" . 'NO:' . "\033[0m" . ' ';
    }
    
    echo $explanation . "\n";
    if ( $print_details ) {
      echo '    Expected: ' . $should_be . "\n";
      echo '    Got: ' . $actual . "\n";
    }
  } 
  
  # Run all tests
  public static function run() {
    # do preparations
    self::prepare();

    # Execute test cases    
    $methods = (new ReflectionClass('tests'))->getMethods(ReflectionMethod::IS_STATIC);
    foreach ( $methods as $method ) {
      if ( strpos($method->name, 'test_') !== 0 ) continue;
      echo 'Running test: ' . str_replace('test_', '', $method->name) . "\n";
      call_user_func(array('tests', $method->name));
      echo "\n";
    }
  }
}