<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/inc/css/site.css',
        'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css',
    ];
    public $js = [
        'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js',
        'https://cdn.jsdelivr.net/gh/windycom/leaflet-kml/L.KML.js',
        'https://cdn.jsdelivr.net/gh/mapbox/togeojson/togeojson.js',
        '/inc/js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
