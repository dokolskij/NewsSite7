<?php
class View
implements Iterator{
   
   public function display($template){
	  $items=$this->items;
	  include __DIR__ .$template;
   }
   
   public function current(){
	  return current($this->items);
   }
   public function next(){
	  next($this->items);
   }
   public function key(){
	  return key($this->items);
   }
   public function valid(){
	  return isset($this->items[$this->key()]);
   }
   public function rewind(){
	  reset($this->items); 
   }
}