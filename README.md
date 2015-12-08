# danCPTFramework
Simples class functions to optimize the Custom Post Fields build process.

### Usage

Just include the php file and use it as a class:

~~~ php
require_once PATH . '/danCPTFramework.php';

$danCPTFw = new danCPTFw();

//Example, prints an input
$danCPTFw->getInput_text("txt_example", "Lorem Ipsum", "color:#333");
~~~

Output:

~~~ html
<input type="text" name="txt_example" value="Lorem Ipsum" style="color:#333" />
~~~
