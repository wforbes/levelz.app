<?php

namespace Auth;

class Test {
	//Testing Post to call a class with a different 
	//	name than its namespace
	public function test1() {
		return ["Test->test1()" =>["Test success"]];
	}
}