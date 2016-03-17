# jade-filter-stylus

This template:
```jade
//- set from php controller
- $prev = $color

//- set in the jade template
- $color = 'red'

head
  :stylus
    p
      color color
      a
        color #{prev}
      em
        color prev
body
  p
    | I'm
    =color
    |  but my links are
    a=prev
    |  and my quotes are
    em=prev
```

with data like this:
```php
$jade = new Jade();
$jade->render('template.jade', array(
    'color' => 'red',
));
```

will be rendered like this:
```html
<head>
  <style type="text/css">
    p {
      color: red;
    }
    p a {
      color: yellow;
    }
    p em {
      color: yellow;
    }
  </style>
</head>
<body>
  <p>
    I'm red but my links are <a>yellow</a> and my quotes are <em>yellow</em>
  </p>
</body>
```
