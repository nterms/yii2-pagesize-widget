yii2-pagesize-widget
====================

PageSize widget is an addition to the \yii\grid\GridView that enables
changing the size of a page on GridView.

To use this widget with a GridView, add this widget to the page:

~~~
<?php echo \nterms\PageSize::widget(); ?>
~~~

and set the `filterSelector` property of GridView as shown in 
following example.

~~~
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