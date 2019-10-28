<?php
/**
 * @copyright Copyright &copy; Saranga Abeykoon, nterms.com, 2014
 * @package yii2-pagesize-widget
 * @version 1.0.0
 */
 
namespace firegroup\widgets\pagesize;

use yii\helpers\Html;

/**
 * PageSize widget is an addition to the \yii\grid\GridView that enables
 * changing the size of a page on GridView.
 *
 * To use this widget with a GridView, add this widget to the page:
 * 
 * ~~~
 * <?php echo \nterms\PageSize::widget(); ?>
 * ~~~
 *
 * and set the `filterSelector` property of GridView as shown in 
 * following example.
 *
 * ~~~
 * <?= GridView::widget([
 *      'dataProvider' => $dataProvider,
 *      'filterModel' => $searchModel,
 * 		'filterSelector' => 'select[name="per-page"]',
 *      'columns' => [
 *          ...
 *      ],
 *  ]); ?>
 * ~~~
 *
 * Please note that `per-page` here is the string you use for `pageSizeParam` setting of the PageSize widget.
 *
 * @author Saranga Abeykoon <amisaranga@gmail.com>
 * @since 1.0
 */
class PageSize extends \yii\base\Widget
{
	/**
	 * @var string the label text.
	 */
	public $label = 'items';
	
	/**
	 * @var integer the defualt page size. This page size will be used when the $_GET['per-page'] is empty.
	 */
	public $defaultPageSize = 20;
	
	/**
	 * @var string the name of the GET request parameter used to specify the size of the page. 
	 * This will be used as the input name of the dropdown list with page size options.
	 */
	public $pageSizeParam = 'per-page';
	
	/**
	 * @var array the list of page sizes
	 */
	public $sizes = [2 => 2, 5 => 5, 10 => 10, 15 => 15, 20 => 20, 25 => 25, 50 => 50, 100 => 100, 200 => 200];
	
	/**
	 * @var string the template to be used for rendering the output.
	 */
	public $template = '{list} {label}';
	
	/**
	 * @var array the list of options for the drop down list.
	 */
	public $options;
	
	/**
	 * @var array the list of options for the label
	 */
	public $labelOptions;
	
	/**
	 * @var boolean whether to encode the label text.
	 */
	public $encodeLabel = true;
	
	/**
	 * Runs the widget and render the output
	 */
	public function run()
	{
		if(empty($this->options['id'])) {
			$this->options['id'] = $this->id;
		}
		
		if($this->encodeLabel) {
			$this->label = Html::encode($this->label);
		}

        $perPage = isset($_POST) && count($_POST) ? self::findSelectedPageSize($_POST) : self::findSelectedPageSize($_GET);
		
		$listHtml = Html::dropDownList($this->pageSizeParam, $perPage, $this->sizes, $this->options);
		$labelHtml = Html::label($this->label, $this->options['id'], $this->labelOptions);
		
		$output = str_replace(['{list}', '{label}'], [$listHtml, $labelHtml], $this->template);
		
		return $output;
	}

    /**
     * Find selected page size key in request array or return default value
     * @param $request
     * @return int
     */
    private function findSelectedPageSize($request) :int{

        if (strpos($this->pageSizeParam, '[') !== false) {
            $keys = preg_split("/[\[\]]/", $this->pageSizeParam, 0,PREG_SPLIT_NO_EMPTY);
            $selectedPageSize = $this->findPageSizeInRequest($keys, $request);
        } else {
            $selectedPageSize = !empty($request[$this->pageSizeParam]) ? $request[$this->pageSizeParam] : $this->defaultPageSize;
        }

        return $selectedPageSize ?? $this->defaultPageSize;
    }

    /**
     * Find page size key in request array recursive
     * @param $keys
     * @param $request
     * @return int
     */
    private function findPageSizeInRequest($keys, $request): int{
        if(isset($request[$keys[0]]) && is_array($request[$keys[0]])){
            $key = $keys[0];
            unset($keys[0]);
            $keys = array_values($keys);
            $selectedPageSize = self::findPageSizeInRequest($keys, $request[$key]);
        } else {
            $selectedPageSize = isset($request[$keys[0]]) ? $request[$keys[0]] : $this->defaultPageSize;
        }

        return $selectedPageSize ?? $this->defaultPageSize;
    }
}
