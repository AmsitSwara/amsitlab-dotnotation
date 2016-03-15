<?php
namespace Amsitlab\Component\DotNotation;

/**
* @package Amsitlab
* @version 1.0
* @author Amsit Swara , amsit.swara@yahoo.com
* @license GNU v2+
*/


Class DotNotation {

/**
* @access protected
* @var Array
*/
protected $array = array();

/** 
* @access protected
* @var Array 
*/
public $tag = array(
 'key' => array('.','='),
 'value' => array('":{"','":"')
);

/** 
* @access protected
* @var Array 
*/
public $temp = array();

/**
* @param array $data
* @param bool $rep 
* @return void
* @since 1.0
*/
public function __construct(array $data=array(),$rep=false){
if($data){
   $this->setOfArray( $data, $rep );
}
}

/**
* @param string $key
* @param string $val
* @return string (json)
* @since 1.0
*/
public function parse( $key, $val=null ){
$val = null == $val ? '' : $val;
$str = '{"';
$str .= str_replace( $this->tag['key'], $this->tag['value'],$key);
$str .= sprintf('":"%s"',$val);
$str .= str_repeat('}',substr_count($key,'.'));
$str .= '}';
return $str;
}



/**
* @param string $key
* @param string $val
* @param bool $replace
* @return DotNotation object
* @since 1.0
*/
public function set( $key, $val = null , $replace=false ){
$parse = $this->parse( $key, $val);
$array = json_decode( $parse, true );
$this->array = is_array( $array ) ? self::merge($this->array,$array,$replace) : $this->array;
if( isset( $this->temp[ $key ] ) ){
         if( $replace === true ) $this->temp[$key] = $val;
} else {
        $this->temp[ $key ] = $val;
}
return $this;
}

/**
* @param array $data
* @param bool $replace
* @return DotNotation object
* @since 1.0
*/
public function setOfArray( array $data, $rep=false){
  $this->array = self::merge($this->array,$data,$rep);
   return $this;
}

/**
* @param string $key
* @param string $def
* @return string
* @since 1.0
*/
public function get( $key, $def = null ){
$p = strtok($key, '.');
$current = array();
$data = $this->array;
$current = $data;
while( $p !== false ){
if( !isset( $current[$p] ) ){
      return $def;
}
$current = $current[$p];
$p = strtok('.');
}
return $current;

}

/**
* Array Recursive Distinct
* @param array $one
* @param array $two
* @param bool $replace
* @return array
* @since 1.0
*/
protected static function merge( array $one, array $two, $replace = false){

 $merged = array();
 $merged = $one;
 foreach( $two as $key => $val ){
   
   if( isset($merged[$key]) ){
      if( is_array( $val ) && is_array( $merged[$key] ) ){
            $merged[$key] = self::merge( $merged[$key] , $val, $replace );
      } else {
           if( $replace === true ){
                    $merged[$key] = $val;
           }
      }
   } else { 
       $merged[$key] =  $val;
   }
 }
return $merged;
}

}
<?php
namespace Amsitlab\Component\DotNotation;

/**
* @package Amsitlab
* @version 1.0
* @author Amsit Swara , amsit.swara@yahoo.com
* @license GNU v2+
*/


Class DotNotation {

/**
* @access protected
* @var Array
*/
protected $array = array();

/** 
* @access protected
* @var Array 
*/
public $tag = array(
 'key' => array('.','='),
 'value' => array('":{"','":"')
);

/** 
* @access protected
* @var Array 
*/
public $temp = array();

/**
* @param array $data
* @param bool $rep 
* @return void
* @since 1.0
*/
public function __construct(array $data=array(),$rep=false){
if($data){
   $this->setOfArray( $data, $rep );
}
}

/**
* @param string $key
* @param string $val
* @return string (json)
* @since 1.0
*/
public function parse( $key, $val=null ){
$val = null == $val ? '' : $val;
$str = '{"';
$str .= str_replace( $this->tag['key'], $this->tag['value'],$key);
$str .= sprintf('":"%s"',$val);
$str .= str_repeat('}',substr_count($key,'.'));
$str .= '}';
return $str;
}



/**
* @param string $key
* @param string $val
* @param bool $replace
* @return DotNotation object
* @since 1.0
*/
public function set( $key, $val = null , $replace=false ){
$parse = $this->parse( $key, $val);
$array = json_decode( $parse, true );
$this->array = is_array( $array ) ? self::merge($this->array,$array,$replace) : $this->array;
if( isset( $this->temp[ $key ] ) ){
         if( $replace === true ) $this->temp[$key] = $val;
} else {
        $this->temp[ $key ] = $val;
}
return $this;
}

/**
* @param array $data
* @param bool $replace
* @return DotNotation object
* @since 1.0
*/
public function setOfArray( array $data, $rep=false){
  $this->array = self::merge($this->array,$data,$rep);
   return $this;
}

/**
* @param string $key
* @param string $def
* @return string
* @since 1.0
*/
public function get( $key, $def = null ){
$p = strtok($key, '.');
$current = array();
$data = $this->array;
$current = $data;
while( $p !== false ){
if( !isset( $current[$p] ) ){
      return $def;
}
$current = $current[$p];
$p = strtok('.');
}
return $current;

}

/**
* Array Recursive Distinct
* @param array $one
* @param array $two
* @param bool $replace
* @return array
* @since 1.0
*/
protected static function merge( array $one, array $two, $replace = false){

 $merged = array();
 $merged = $one;
 foreach( $two as $key => $val ){
   
   if( isset($merged[$key]) ){
      if( is_array( $val ) && is_array( $merged[$key] ) ){
            $merged[$key] = self::merge( $merged[$key] , $val, $replace );
      } else {
           if( $replace === true ){
                    $merged[$key] = $val;
           }
      }
   } else { 
       $merged[$key] =  $val;
   }
 }
return $merged;
}

}
