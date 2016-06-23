# pug-filter-stylus

This template:
```pug
//- set from php controller
- $prev = $color

//- set in the pug template
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
$pug = new Pug();
$pug->render('template.pug', array(
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
