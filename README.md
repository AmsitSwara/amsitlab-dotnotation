Access Multiple Array With Dot Notation

Exemple:
```php
use Amsitlab\Component\DotNotation\DotNotation;

$data = array('profile' => array('name' =>array('First' => 'Amsit')));

$dot = new DotNotation( $data );
$dot->set('profile.name.last','Swara');

echo $dot->get('profile.name.first') , ' ' , $dot->get('profile.name.last'); //Output: Amsit Swara
```
# amsitlab-dotnotation
Php Dot Notation Array Access
