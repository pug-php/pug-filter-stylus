# pug-filter-stylus

[![Latest Stable Version](https://poser.pugx.org/pug-php/pug-filter-stylus/v/stable.png)](https://packagist.org/packages/pug-php/pug-filter-stylus)
[![Build Status](https://travis-ci.org/pug-php/pug-filter-stylus.svg?branch=master)](https://travis-ci.org/pug-php/pug-filter-stylus)
[![Code Climate](https://codeclimate.com/github/pug-php/pug-filter-stylus/badges/gpa.svg)](https://codeclimate.com/github/pug-php/pug-filter-stylus)
[![Test Coverage](https://codeclimate.com/github/pug-php/pug-filter-stylus/badges/coverage.svg)](https://codeclimate.com/github/pug-php/pug-filter-stylus/coverage)
[![StyleCI](https://styleci.io/repos/61811961/shield?branch=master)](https://styleci.io/repos/61811961)

This template:
```pug
//- set from php controller
- $prev = $color

//- set in the pug template
- $color = 'red'

head
  :stylus
    prev = yellow
    p
      color #{color}
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
