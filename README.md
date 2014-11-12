yii2-pagesize-widget
====================

PageSize widget is an addition to the [Yii2](https://github.com/yiisoft/yii2) [GridView](http://www.yiiframework.com/doc-2.0/yii-grid-gridview.html) that enables
changing the size of a page on GridView.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist nterms/yii2-pagesize-widget "*"
```

or add

```
"nterms/yii2-pagesize-widget": "*"
```

to the require section of your `composer.json` file.


Usage
-----

To use this widget with a GridView, add this widget to the view where the GridView is:

~~~php
<?php echo \nterms\pagesize\PageSize::widget(); ?>
~~~

and set the `filterSelector` property of GridView as shown in 
following example.

~~~php
<?= GridView::widget([
     'dataProvider' => $dataProvider,
     'filterModel' => $searchModel,
		'filterSelector' => 'select[name="per-page"]',
     'columns' => [
         ...
     ],
 ]); ?>
~~~

Please note that `per-page` here is the string you use for `pageSizeParam` setting of the PageSize widget.

Configurations
--------------

Following properties are available for customizing the widget.

- `label`: Text for the lbel
- `defaultPageSize`: This value will be used if there's no page size selected
- `pageSizeParam`: The name of the page size parameter used for the pagination widget in your grid view
- `sizes`: An array of key values to be used as page sizes. Both kay and value should be integers
- `template`: A template string to be used for rendering the elements. Default is `'{list} {label}'`
- `options`: HTML attributes for the `<select>` element
- `labelOptions`: HTML attributes for the `<label>` element
- `encodeLabel`: Whether to encode label text

License
-------

[MIT](LICENSE.md)