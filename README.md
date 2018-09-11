# Front Matter

This uses [Parsedown](http://parsedown.org/) and 
[Symfony/Yaml](https://symfony.com/doc/current/components/yaml.html).

## Example

This is an example source file. It has YAML at the top and Markdown under that.

```yaml
---
title: Hello World
---
    
# Hello World

It is i, levi.

[test](https://google.com)
```

Then we use the following PHP to read the config and the HTML.

```php
<?php

include 'vendor/autoload.php';

$fm = Bulldog\FrontMatter::load('file.yaml');

var_dump($fm->config());
// Output
/*
array(1) {
  'title' =>
  string(11) "Hello World"
}
 */

var_dump($fm->html());
// Output
/*
string(85) "<h1>Hello World</h1><p>It is i, levi.</p><p><a href="https://google.com">test</a></p>"
 */
```
