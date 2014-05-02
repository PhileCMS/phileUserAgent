phileUserAgent
==============

A plugin for [Phile](https://github.com/PhileCMS/Phile) to expose browser user-agent data to the template.

### 1.1 Installation (composer)
```
php composer.phar require phile/user-agent:*
```
### 1.2 Installation (Download)

* Install the latest version of [Phile](https://github.com/PhileCMS/Phile)
* Clone this repo into `plugins/phile/userAgent`

### 2. Activation

After you have installed the plugin. You need to add the following line to your `config.php` file:

```
$config['plugins']['phile\\userAgent'] = array('active' => true);
```

### Usage

This plugin will create a new variable in your template called `{{ useragent }}`.

You can use this varaible to load conditional content, add special classes, or even modify your javascript.

#### Exposed Infomation

Here is an example (from my laptop) of the full useragent array:

```php
array(
  'useragent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.6 Safari/537.36', // full useragent string
  'name' => 'Google Chrome', // name of the browser
  'browser' => 'google-chrome', // css safe browser name
  'version' => '32.0.1700.6', // browser version number
  'type' => 'desktop', // form factor browser || mobile
  'platform' => 'mac', // Operating System
  'pattern' => '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#' // regex pattern that matched
);
```

#### Conditional Content

```html
{% if browser.type == 'desktop' %}
  <div class="desktop-header-image">
    <img src="images/desktop.jpg" alt="desktop screenshot">
  </div>
{% else %}
  <div class="mobile-header-image">
    <img src="images/mobile.jpg" alt="mobile screenshot">
  </div>
{% endif %}
```
#### Special Classes

```html
<body class="{{ useragent.platform }} {{ useragent.type }}">
  <div class="content">
    {{ content }}
  </div>
</body>
```

#### Javascript Additions

If we put this code in the *head of our document*, we can encode the `{{ useragent }}` array as json and use it in our javascript:

```javascript
<script type="text/javascript">
  window.Phile.useragent = {{ useragent|json_encode() }};
</script>
```

Now `Phile.useragent.browser` would return the CSS safe browser name in our javascript.
