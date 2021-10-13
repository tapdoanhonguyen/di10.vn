<?php
namespace NukeViet\StoreHouse;
class Myclass {
	public function __construct(Array $properties=array()){
      foreach($properties as $key => $value){
        $this->{$key} = $value;
      }
    }
}