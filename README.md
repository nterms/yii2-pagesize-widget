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
<?php echo \nterms\PageSize::widget(); ?>
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

License
-------

[MIT](LICENSE.md)